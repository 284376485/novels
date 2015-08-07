<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_031000_creat_bookinfo_table extends Migration
{
    public function up()
    {
        $LinkColumn = array(
                'id' => 'pk NOT NULL COMMENT "主键"',
                'Class' => 'INT NOT NULL COMMENT "小说分类"',
                'bookname' => 'TEXT NOT NULL COMMENT "小说名字"',
                'bookname_pinyin' => 'TEXT NOT NULL COMMENT "小说名字拼音化"',
                'author' => 'TEXT NOT NULL COMMENT "作者名"',
                'Description' => 'TEXT NOT NULL COMMENT "小说描述"',
                'updatetime' => 'DATETIME DEFAULT "0000-00-00 00:00:00" COMMENT "小说添加时间"',
                'status' => 'tinyint(1) NOT NULL COMMENT "小说状态 0完结 1连载"',
                'img' => 'TEXT NOT NULL COMMENT "小说图片名"',
                'Home_Recommended' => 'int(1) NOT NULL COMMENT "首页6本小说的推荐"',
                'Home_Recommended_Right' => 'int(1) NOT NULL COMMENT "首页右边推荐小说"',
                'article_last_id' => 'int(11) NOT NULL COMMENT "本小说最新章节ID"',
                'article_last_title' => 'text NOT NULL COMMENT "本小说最新章节标题"',
                'article_last_updatetime' => 'DATETIME DEFAULT "0000-00-00 00:00:00" COMMENT "本小说最新章节更新时间"'
            );
            $linkOptions = ' ENGINE=Innodb DEFAULT CHARSET=utf8';
            $this->createTable('bookinfo', $LinkColumn, $linkOptions);
    }

    public function down()
    {
        echo "m150731_031000_creat_bookinfo_table cannot be reverted.\n";
        $this->dropTable('bookinfo');
        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
