<?php 
namespace app\models;

use app\models\bookinfo;


class IndexModel{
	public function Get_Now_update()
	{
		$bookinfo_query = bookinfo::find();
		$bookinfo = $bookinfo_query
						->limit(30)
						->orderBy('article_last_updatetime desc')
						->asArray()
						->all();
		//var_dump($bookinfo);
		return $bookinfo;
	}

	public  function Judge_Book_Status($status){
		switch ($status) {
			case '0':
				return '完结';
				break;
			
			default:
				return '连载';
				break;
		}
	}

	public function add_click($bookid,$click){
		$bookinfo_query = new bookinfo;
		$bookinfo = $bookinfo_query->findOne($bookid);
		$bookinfo->click=($click+1);
		$bookinfo->save();
	}

	public function memcache(){
		$men = new memcache();
		$men = $men->connect('127.0.0.1');
		return $men;
	}
}