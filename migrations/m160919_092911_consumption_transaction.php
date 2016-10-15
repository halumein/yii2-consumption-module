<?php

use yii\db\Schema;
use yii\db\Migration;

class m160919_092911_consumption_transaction extends Migration
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
            '{{%consumption_transaction}}',
            [
                'id'=> Schema::TYPE_PK."",
                'date'=> Schema::TYPE_DATETIME." NOT NULL",
                'ident'=> Schema::TYPE_INTEGER."(11) NOT NULL",
                'element_model'=> Schema::TYPE_STRING."(255) NOT NULL",
                'element_id'=> Schema::TYPE_INTEGER."(11) NOT NULL",
                'count'=> Schema::TYPE_DECIMAL."(10,3) NOT NULL",
                'resource_id'=> Schema::TYPE_INTEGER."(11) NOT NULL",
                'type'=> "enum('income','outcome')"." NOT NULL",
                'amount'=> Schema::TYPE_DECIMAL."(10,3) NOT NULL",
                'deleted'=> Schema::TYPE_DATETIME."",
                'comment'=> Schema::TYPE_STRING."(500) NOT NULL",
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consumption_transaction}}');
    }
}
