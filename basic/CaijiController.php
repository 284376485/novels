<?php
namespace app\controllers;
use yii;
use yii\web\Controller;
use phpQuery;
use app\models\bookinfo;
use app\models\TransPinyin;
use app\models\article;
include 'phpQuery.php'; 


class CaijiController extends controller
{
	//访问首页获取源码
	public function actionIndex(){
		ini_set('memory_limit','-1M');
		set_time_limit(0);
		//采集值得买的全部发现列表
		$url = "http://www.moksos.com";
		self::Get_Index_All_Update($url);

	}

	public function Get_Index_All_Update($Index_Url){
		@phpQuery::newDocumentFileHTML($Index_Url);
		$Index_All_Link_Len = phpQuery::pq('.tit_n')->length();		
		
		for ( $i = 0 ; $i < $Index_All_Link_Len ; $i++){
			$Link=phpQuery::pq('.tit_n:eq('.$i.')')->attr('href'); //获取链接
			$Link_Array[] = $Link;
		}

		self::Get_Mulu_All_Article_Link($Link_Array);

	}
	
	public function Get_Mulu_All_Article_Link($Mulu_Url){
		// var_dump($Mulu_Url);exit;
		foreach ($Mulu_Url as $url) {
			@phpQuery::newDocumentFileHTML('http://www.moksos.com'.$url);
				$bookname = phpQuery::pq('.umg > img')->attr('alt'); //bookname
				$Description = phpQuery::pq('.u-bx > p')->text();//Description
				$author = explode("：",phpQuery::pq('.auths')->text())[1];//author
				$update_time = date("Y-m-d H:i:s",time());//book update_time
				$class = phpQuery::pq('.v-nav')->text();
				$img ='http://www.moksos.com'.phpQuery::pq('.umg > img')->attr('src');
				//获取分类 return 'xuanhuan'等
				$class = self::Get_Class($class);

			//目录页文章链接获取
			$Mulu_All_Link_Len = phpQuery::pq('.pox > li > a')->length();	
				for($i = 0 ; $i < $Mulu_All_Link_Len ;$i++)
				{
					$Mulu_All_Url = phpQuery::pq('.pox > li > a:eq('.$i.')')->attr('href');
					$Mulu_All_Title[] = phpQuery::pq('.pox > li > a:eq('.$i.')')->html();
					$Mulu_All_Link_Array[] = 'http://www.moksos.com'.$url.$Mulu_All_Url;
				}

			//判断是否有重复bookname 如没有重复 则插入数据到bookinfo 
			//return 0 不重复 1 重复
			$bookinfo_Array=self::Judge_Repeat_Book($bookname);
			if(!empty($bookinfo_Array)){
					$key = 0 ;
					$article_last_title = $bookinfo_Array['article_last_title'];
						foreach ($Mulu_All_Title as $key => $value) {
								if($value == $article_last_title)
									break;
						}

					for($i=$key+1 ; $i < count($Mulu_All_Link_Array) ; $i++){
						//插入article数据库
						$content = self::Get_Content($value);
						$article_title = $Mulu_All_Title[$i];
						echo self::Inset_New_Article($bookname,$article_title,$content);
					}
			}else{
					//插入bookinfo 且插入article 从第一章开始
					if( self::insert_Book_Info($class,$bookname,$author,$Description,$update_time) )
							echo '<'.$bookname.'>'.'插入成功'.'<br>';
						else
							echo '<'.$bookname.'>'.'插入失败'.'<br>';
					 self::Get_pic($bookname,$img);

					foreach ($Mulu_All_Link_Array as $key => $value) {
							$content = self::Get_Content($value);
							echo self::Inset_New_Article($bookname,$Mulu_All_Title[$key],$content);
							ob_flush();
							flush();
					}
					
			}
				//return 1 重复 0 不重复
				// if(!self::Judge_Repeat_Article(end($Mulu_All_Title))){
				// 	self::Get_Content($bookname,$Mulu_All_Link_Array);

				// }
				// self::Get_Content($bookname,$Mulu_All_Link_Array);
				//self::Get_Content($bookname,$Mulu_All_Link_Array);
				ob_flush();
				flush();
				unset($Mulu_All_Title);
				unset($Mulu_All_Link_Array);
		}
	}

	//获取章节页面内容和标题
	public function Get_Content($Artcile_Content_Url){
		//foreach ($Artcile_Url_Array as $key => $value) {
				@phpQuery::newDocumentFileHTML($Artcile_Content_Url);
				$content = phpQuery::pq('.zhang-txt-nei-rong')->html();
				return $content;
		//}
	
	}

	//判断是否有重复书名
	public function Judge_Repeat_Book($bookname){
		$bookinfo = new bookinfo();
		$bookinfo_Array = $bookinfo->find()
		                           ->where(['bookname'=>$bookname])
								   ->asArray()
								   ->one();
		//var_dump($bookinfo_Array);exit;
		return $bookinfo_Array;
		if(!empty($bookinfo_Array))
			return 1 ; //重复 
		else
			return 0 ; //不重复
	}

	//插入新书
	public function insert_Book_Info($class,$bookname,$author,$Description,$update_time){
			$bookinfo = new bookinfo();
			$Pinyin   = new TransPinyin();
			$bookname_pinyin = $Pinyin->Pinyin($bookname);
			$status = 1 ;
					
			$return_status= $bookinfo->find()->createCommand()->insert('bookinfo', [
								    'class' => $class,
								    'bookname' => $bookname,
								    'bookname_pinyin'=>$bookname_pinyin,
								    'author' => $author,
								    'Description' => $Description,
								    'updatetime' => $update_time,
								    'status' => $status,
								])->execute();
			echo '先插入bookinfo'.'<br>';
			return $return_status;
	}
	//插入章节
	public function Inset_New_Article($bookname,$article_title,$content){
		$article = new article();
		$bookinfo = new bookinfo();
		$Pinyin = new TransPinyin();
		$bookname_pinyin = $Pinyin->Pinyin($bookname);
		$bookid = $article->Get_Book_Id($bookname);
		$update = date("Y-m-d H:i:s",time());
		//插入article表 章节信息
		$return_status = $article->find()
								 ->createCommand()
								 ->insert('article',[
								 	'bookid' => $bookid,
								 	'article_title' => $article_title,
								 	//'content' => $content,
								 	'update' => $update,
								 	])->execute();

		//获取本小说最后一章节articleid
		$Get_Article_Last_Id = $article->Get_Last_Article_Id($bookid);

		//创建目录且写入文本
		self::mkdir_and_write($bookname_pinyin,$Get_Article_Last_Id,$content);
		echo '写入路径->novel_directory/'.$bookname_pinyin.'/'.$Get_Article_Last_Id.'.txt<br>';
		//更新bookinfo信息
		$return_status = self::Update_Book_Info($bookid,$Get_Article_Last_Id,$article_title);
			if($return_status)
				echo '更新info信息成功->《'.$bookname.'》最新章节->'.$article_title.'<br>';
		// exit;
	}	

	public function Get_Class($class){
			$Class = Yii::$app->params['Class'];
			$class = explode('>',$class);
			$class = explode(' ',$class[1]);
			$class = $class[1];

			foreach ($Class as $key => $value) {
				if($value == $class){
					$class = $key;
					break;
				}
			}
			unset($Class);
		return $class;
	}
	//判断状态 return 1 连载 0 完结
	public function Judge_Book_Status($status){
		if($status == '连载')
			return 1 ;
		else
			return 0 ;
	}
	//插入本小说所有article后 更新bookinfo信息
	public function Update_Book_Info($bookid,$article_last_id,$article_title){
		$bookinfo = new bookinfo();
		$article_last_updatetime = date("Y-m-d H:i:s",time());
		$update=$bookinfo->findOne($bookid);
	   	$update->article_last_id = $article_last_id;
	   	$update->article_last_title = $article_title;
	   	$update->article_last_updatetime = $article_last_updatetime;
	   	return $update->save();
	}

	public function mkdir_and_write($bookname_pinyin,$id,$content){
		$path = 'novel_directory/'.$bookname_pinyin;
			@$res=mkdir(iconv("UTF-8", "GBK", $path),0777,true); 

				$find = strpos($content,'bd-load-s');
				$content = substr($content,0,$find-1).'<br><br><br>';
				$myfile = fopen($path.'/'.$id.".txt", "w") or die("Unable to open file!");
				fwrite($myfile, $content);
				fclose($myfile);
	}
	public function Get_Pic($bookname,$url){
		$img = file_get_contents($url); 
		$Pinyin = new TransPinyin();
		$bookname_pinyin = $Pinyin->Pinyin($bookname);
		file_put_contents('BookImages/'.$bookname_pinyin.'.jpg',$img); 
	}
}
