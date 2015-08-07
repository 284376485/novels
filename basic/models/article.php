<?php
namespace app\models;
use app\models\bookinfo;

class article extends \yii\db\ActiveRecord{
	//通过bookname表 id 获取article表id 
	public function Get_All_Article_Id($id){
		$Article_Id_Query = article::find();
		$Article_Id_Array = $Article_Id_Query->where(['bookid'=>$id])->asArray()->all();
		// var_dump($Article_Id_Array);
		return $Article_Id_Array;
	}
	//获取首页章节最新更新
	public function Get_Now_update(){
		$article_query = article::find();
		$bookinfo_query = new bookinfo;
		$update = $article_query->limit(30)->asArray()->orderBy('id desc')->all();
		foreach ($update as $key => $updatebook) {
			$update[$key]['bookname'] = $bookinfo_query->Get_bookinfo($updatebook['bookid']);
		}

		return $update;
	}
	//通过bookname 获取 bookid return bookid
	public function Get_Book_Id($bookname){
		$bookinfo = new bookinfo();
		$bookid = $bookinfo->find()
						   ->where(['bookname'=>$bookname])
						   ->asArray()
						   ->One();
		return $bookid['id'];
	}
	//通过bookid 获取 本小说最后一章节articleid
	public function Get_Last_Article_Id($bookid){
		$article = new article();
		$article_Array = $article->find()
								 ->where(['bookid'=>$bookid])
								 ->orderBy('id desc')
								 ->asArray()
								 ->one();
		return $article_Array['id'];
	}
}