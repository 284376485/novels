<?php
namespace app\controllers;
use yii\web\Controller;
use phpQuery;
include 'phpQuery.php'; 


//采集值得买的全部发现列表
class CollectionController extends controller
{


	//访问首页获取源码
	public function actionCollection()
	{
		
		ini_set('memory_limit','-1M');
		set_time_limit(0);
		//采集值得买的全部发现列表
		$url = "http://faxian.smzdm.com";
		while(1)
		{
			$url = self::smzdmcaiji($url);
			if($url == "")
				break;
		}
	}

	public	 function smzdmcaiji($url)
	{
		phpQuery::newDocumentFileHTML($url);
		$CollectionLen = phpQuery::pq('h2.itemName > a')->length();	//获取匹配总数
		for($i = 0 ; $i < $CollectionLen; $i++)
		{
			
			$title=$titleElement = phpQuery::pq('h2.itemName > a > span.black:eq('.$i.')')->html();//title
			$price=$titleElement = phpQuery::pq('h2.itemName > a > span.red:eq('.$i.')')->html();//price
			$Direct_url=$titleElement = phpQuery::pq('div.item_buy_mall > a:eq('.$i.')')->attr('href');
			$pic=$titleElement = phpQuery::pq('li.list > a > img:eq('.$i.')')->attr('src');//pic
			$nextpage=$titleElement = phpQuery::pq('li.pagedown > a')->attr('href');//nextpage
			if($title && $price && $Direct_url && $pic)
			{
				$insertsuccess=self::insertDB('smzdm',$title , $price , $Direct_url , $pic);
				if($insertsuccess)
					echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品采集完成'.'<br>';
				else
					echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品插入数据库失败,已有相同商品'.'<br>';
			}
			else if(!$title)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商无标题,不插入数据库'.'<br>';
			else if(!$price)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品无价格,不插入数据库'.'<br>';
			else if(!$Direct_url)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品无直达连接,不插入数据库'.'<br>';
			else if(!$pic)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品无图片地址,不插入数据库'.'<br>';
			else 
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品未知原因,不插入数据库'.'<br>';
		}
			//sleep(1);
			ob_flush();
			flush();

			return $nextpage;
	}

	public function insertDB($dbname,$title , $price , $Direct_url , $pic )
	{
		$connection = \Yii::$app->db;
		//查询数据库中是否有相同标题的商品
		$title = addslashes($title);
		$command = $connection->createCommand('SELECT title FROM '.$dbname.' WHERE title like '."'$title'");
		$titles = $command->queryOne();
		if(!$titles)	
		{
			return	$connection->createCommand()->insert($dbname, [
   		 	'title' => $title,
		 	'Direct_url' => $Direct_url,
		 	'price' => $price,
			 'pic' => $pic,
	 		])->execute();
		}
		else
			return 0 ;
	 
	}
	
	public function actionHaitao()
	{
		//采集海淘的全球购列表
		$page=1;
		$url = "http://item.haitao.com/s/index.php?page=".$page;
		while(1)
		{
			$flag = self::haitaocaiji($url); //返回本页是否有数据 有数据返回1 无数据返回0
			$page++;
			$url = "http://item.haitao.com/s/index.php?page=".$page;
			if($flag == 0)
			{	
				echo '海淘全部页面采集结束';
				break;
			}
		}
	}

	public	 function haitaocaiji($url)
	{
		phpQuery::newDocumentFileHTML($url);
		$CollectionLen = phpQuery::pq('div.item_pic_img > a')->length();		//获取匹配总数

		for($i = 0 ; $i < $CollectionLen; $i++)
		{
			$title = phpQuery::pq('p.item_title >a:eq('.$i.')')->text();		//title
			$price = phpQuery::pq('div.item_price_down > p.fl:eq('.$i.')')->text();			//price
			$Direct_url = phpQuery::pq('p.item_title > a:eq('.$i.')')->attr('href');//Direct_url
			
			$ID= substr($Direct_url,23,strlen($Direct_url)-28);			//获取连接数字ID
			
			$Direct_url = 'http://r.haitao.com/?t=product&id='.$ID;
			
			$pic = phpQuery::pq('div.item_pic_img > a > img:eq('.$i.')')->attr('src');	//pic
			
			if($title && $price && $Direct_url && $pic)
			{
				$insertsuccess=self::insertDB('haitao',$title , $price , $Direct_url , $pic);
				if($insertsuccess)
					echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品采集完成'.'<br>';
				else
					echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品插入数据库失败,已有相同商品'.'<br>';
			}
			else if(!$title)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商无标题,不插入数据库'.'<br>';
			else if(!$price)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品无价格,不插入数据库'.'<br>';
			else if(!$Direct_url)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品无直达连接,不插入数据库'.'<br>';
			else if(!$pic)
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品无图片地址,不插入数据库'.'<br>';
			else 
			{
				echo '当前页：'.$url.'=>'.'第'.($i+1).'个商品未知原因,不插入数据库'.'<br>';
				return 0;
			}
		}
			//sleep(1);
			ob_flush();
			flush();
			return 1;
	}

}
