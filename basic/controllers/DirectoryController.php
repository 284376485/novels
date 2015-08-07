<?php

namespace app\Controllers;
use yii;
use yii\web\Controller;
use app\models\bookinfo;
use app\models\article;
use app\models\TransPinyin;
use app\models\IndexModel;

//小说目录
class DirectoryController extends Controller
{
	public function actionIndex(){
		$IndexModel = new IndexModel();
		$memcache=Yii::$app->cache;
		$now_time = date("i",time());
		

		$bookname_pinyin = $_GET['bookname'];
		$article_id = $_GET['article_id'];
		
		if($article_id == 'index')
				$action = 'index';
			else 
				$action = 'content';
		if($now_time % 10 == 0)
			$memcache->delete('Directory_bookinfo_'.$bookname_pinyin);

		if(empty($memcache->get('Directory_bookinfo_'.$bookname_pinyin))){
			$bookinfo = new bookinfo();
			
			$article  = new article();
			
			$book_info = $bookinfo->Get_bookinfo_pinyin($bookname_pinyin);
			
			if(empty($book_info))
				$this->redirect('/404.php',404);//如果本小说不存在 则跳转404页面
			
			$article_info = $article->Get_All_Article_Id($book_info['id']);

			$memcache->set('Directory_bookinfo_'.$bookname_pinyin,$book_info);
			$memcache->set('Directory_articleinfo_'.$bookname_pinyin,$article_info);
			$memcache->set('Directory_articleid_'.$bookname_pinyin,$article_id);
		    return $this->render($action,[
					'bookinfo' => $memcache->get('Directory_bookinfo_'.$bookname_pinyin),
				 	'article_info' => $memcache->get('Directory_articleinfo_'.$bookname_pinyin),
				 	'article_id' => $memcache->get('Directory_articleid_'.$bookname_pinyin),
				]);
		 }
		 else{
		 	return $this->render($action,[
					'bookinfo' => $memcache->get('Directory_bookinfo_'.$bookname_pinyin),
				 	'article_info' => $memcache->get('Directory_articleinfo_'.$bookname_pinyin),
				 	'article_id' => $memcache->get('Directory_articleid_'.$article_id)
				]);
		 }

	}
}