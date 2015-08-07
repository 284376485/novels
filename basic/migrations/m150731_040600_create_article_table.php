<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_040600_create_article_table extends Migration
{
    public function up()
    {
            $LinkColumn = array(
                    'id' => 'pk NOT NULL COMMENT "主键"',
                    'bookid' => 'int(11) NOT NULL COMMENT "小说ID"',
                    'article_title' => 'text NOT NULL COMMENT "章节标题"',
                    'update' => 'DATETIME DEFAULT "0000-00-00 00:00:00" COMMENT "更新时间"',
                );
            $linkOptions = ' ENGINE=Innodb DEFAULT CHARSET=utf8';
            $this->createTable('article', $LinkColumn, $linkOptions);
    }

    public function down()
    {
        echo "m150731_040600_create_article_table cannot be reverted.\n";
        $this->dropTable('articles');
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
