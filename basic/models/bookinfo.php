<?php
namespace app\models;

class bookinfo extends \yii\db\ActiveRecord
{
	//获取bookinfo中相同作者的书
	public function Check_Author_Other_Book($AuthorName){
		$query  = bookinfo::find();
		$author = $query->where(['author'=>$AuthorName])
					 	->asArray()
					 	->all();
		return $author;
	}
	//首页推荐
	public function Obtain_Home_Recommended(){
		$query = bookinfo::find();
		$Home_Recommended = $query->where(['Home_Recommended'=>1])
							 	  ->asArray()
							 	  ->all();
		return $Home_Recommended;
	}
	//获取根据 id 得到书名和作者信息
	public function Get_bookinfo($id){
		$query = bookinfo::find();
		$book  = $query->where(['id' => $id])
					   ->asArray()
					   ->One();
		return $book;
	}
	//根据拼音书名 得到信息
		public function Get_bookinfo_pinyin($bookname_pinyin){
		$query = bookinfo::find();
		$book  = $query->where(['bookname_pinyin' => $bookname_pinyin])
					   ->asArray()
					   ->One();
		return $book;
	}
	//首页右边推荐小说
	public function Recommendation_Right(){
		$bookinfo = bookinfo::find();
		$Recommendation_Right = $bookinfo->where(['Home_Recommended_Right'=>1])
										 ->asArray()
										 ->all();
		return $Recommendation_Right;
	}
	//首页下部最新更新小说
	public function Home_New_Book_updata(){
		$bookinfo = bookinfo::find();
		$Home_New_Book_updata = $bookinfo->orderBy('updatetime desc')
										 ->limit(14)
										 ->all();
		return $Home_New_Book_updata;
	}
}