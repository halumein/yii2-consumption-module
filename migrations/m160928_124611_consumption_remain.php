<?php

use yii\db\Schema;
use yii\db\Migration;

class m160928_124611_consumption_remain extends Migration
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
            '{{%consumption_remain}}',
            [
                'id'=> $this->primaryKey(11),
                'income_id'=> $this->integer(11)->notNull(),
                'amount'=> $this->decimal(10, 3)->notNull(),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consumption_remain}}');
    }
}
