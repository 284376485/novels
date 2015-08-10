<?php

namespace app\commands;

use yii\console\Controller;

class HelloController extends Controller
{

    public function actionIndex($msg = 'hello world')
    {
    	while(1)
    	{
		echo $msg;
    		sleep(5);
    	}
    }

  
}
