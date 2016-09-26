<?php

use yii\db\Schema;
use yii\db\Migration;

class m160919_092911_consumption_consume extends Migration
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
            '{{%consumption_consume}}',
            [
                'id'=> $this->primaryKey(11),
                'date'=> $this->datetime()->notNull(),
                'ident'=> $this->integer(11)->notNull(),
                'element_model'=> $this->string(255)->notNull(),
                'element_id'=> $this->integer(11)->notNull(),
                'resource_id'=> $this->integer(11)->notNull(),
                'consume'=> $this->decimal(10, 3)->notNull(),
                'comment'=> $this->string(500)->notNull(),
                'deleted'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('resource_id','{{%consumption_consume}}','resource_id',true);
    }

    public function safeDown()
    {
        $this->dropIndex('resource_id', '{{%consumption_consume}}');
        $this->dropTable('{{%consumption_consume}}');
    }
}
