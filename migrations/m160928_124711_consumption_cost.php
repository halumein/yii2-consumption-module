<?php

use yii\db\Schema;
use yii\db\Migration;

class m160928_124711_consumption_cost extends Migration
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
            '{{%consumption_cost}}',
            [
                'id'=> $this->primaryKey(11),
                'transaction_id'=> $this->integer(11)->notNull(),
                'income_id'=> $this->integer(11)->null()->defaultValue(null),
                'consume_amount'=> $this->decimal(10, 3)->notNull(),
                'date'=> $this->datetime()->notNull(),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consumption_cost}}');
    }
}
