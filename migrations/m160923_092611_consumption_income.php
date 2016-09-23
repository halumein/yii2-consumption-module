<?php

use yii\db\Schema;
use yii\db\Migration;

class m160923_092611_consumption_income extends Migration
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
            '{{%consumption_income}}',
            [
                'id'=> $this->primaryKey(11),
                'date'=> $this->datetime()->notNull(),
                'resource_id'=> $this->integer(11)->notNull(),
                'income'=> $this->decimal(3, 10)->notNull()->defaultValue('0.000'),
                'cost'=> $this->decimal(2, 10)->notNull()->defaultValue('0.00'),
                'balance'=> $this->decimal(3, 10)->notNull()->defaultValue('0.000'),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consumption_income}}');
    }
}
