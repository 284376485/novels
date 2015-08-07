<?php
namespace app\Controllers;
use yii\web\Controller;
use app\models\bookinfo;

class SearchController extends Controller{
	public $enableCsrfValidation = false;
	public function actionIndex(){
		$keywords = $_GET['keyword'];
		$array = bookinfo::find()->andFilterWhere(['like','bookname',$keywords])
								->orwhere(['like','author',$keywords])
								->orwhere(['like','bookname_pinyin',$keywords])
								->asArray()
								->all();
		//var_dump($array);exit;
		//$this->redirect('http://www.baidu.com'); 可跳转
		return $this->render('index',[
					'keywords' => $keywords,
					'search_result' => $array,
				]);
	} 
}

?>
