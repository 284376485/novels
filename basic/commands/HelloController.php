<?php

namespace app\commands;

use yii\console\Controller;

class HelloController extends Controller
{

    public function actionIndex($msg = 'hello world')
    {
    	while(1)
    	{
    		slef::Test($mes);
    		sleep(5);
    	}
    }

    public function actionTest($msg){
    	echo $msg;
    }
}
