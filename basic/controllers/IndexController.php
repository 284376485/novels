<?php

namespace app\controllers;

use yii\db\ActiveRecord;
use yii\web\Controller;
use app\models\message;
use app\models\bookinfo;
use app\models\article;
use app\models\TransPinyin;
use app\models\IndexModel;

class IndexController extends Controller{
public function actionIndex(){
$bookinfo = new bookinfo;
$article  = new article;
$Pinyin = new TransPinyin();
$update = new IndexModel();
$update = $update->Get_Now_update();
$Recommendation_Right = $bookinfo->Recommendation_Right();
$bookinfo_updata = $bookinfo->Home_New_Book_updata();
return $this->render('index',[
'Now_Update' => $update,    //首页最近更新
'Home_Recommended'=> $bookinfo,//首页推荐
'Pinyin' => $Pinyin,  //文字转换成拼音
'Recommendation_Right'=>$Recommendation_Right,//首页右边推荐小说
'Home_New_Book_updata'=> $bookinfo_updata,//首页最新更新小说
]);
}



 
}
