<?php

use yii\db\Schema;
use yii\db\Migration;

class m160920_102211_consumption_category extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%consumption_category}}',
            [
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->notNull(),
                'parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consumption_category}}');
    }
}
