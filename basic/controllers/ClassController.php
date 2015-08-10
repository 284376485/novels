<?php 
namespace app\controllers;

use yii\web\Controller;
use app\models\bookinfo;
use yii\data\Pagination;


class ClassController extends controller
{
	/**
	 * @参数1 $Class
	 */
	public function actionIndex(){
		$class = $_GET['class'];
		$page  = $_GET['page'];
		//获取分类页的文章 按照最新更新时间排序
		$bookinfo = bookinfo::find()->where(['Class'=>$class]);
		$pagination = new Pagination([
            'defaultPageSize' => 30,
            'totalCount' => $bookinfo->count(),
        ]);	
		$Class_Novel = $bookinfo//->where(['Class'=>$class])
								->orderBy('article_last_updatetime desc')
								->offset($pagination->offset)
								->limit($pagination->limit)
								->asArray()
								->all();

		//判断是否是本分类的推荐
		$Class_Recommendation = self::Class_Recommendation($class);
		
		return $this->render('index',[
					'Class_Novel' => $Class_Novel,//array
					'pagination'  => $pagination,//array
					'Class_Recommendation'=>$Class_Recommendation,
					'Now_Page'    => $page,//变量
			]);
			
	}
	/*
	*判断是否是本分类的推荐
	*return $Class_Recommendation [Array] 
	*/
	public function Class_Recommendation($class){
		$bookinfo = new bookinfo();
		$Class_Recommendation = $bookinfo->find()
										 ->andwhere(['Class_Recommendation'=>1 ,'Class'=>$class])
										 ->asArray()
										 ->all();
		return $Class_Recommendation;
	}

}
