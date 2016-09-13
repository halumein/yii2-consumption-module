<?php

use yii\db\Schema;
use yii\db\Migration;

class m160913_114811_consumption_norm extends Migration
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
            '{{%consumption_norm}}',
            [
                'id'=> $this->primaryKey(11),
                'element_model'=> $this->string(255)->notNull(),
                'element_id'=> $this->integer(11)->notNull(),
                'resource_id'=> $this->integer(11)->notNull(),
                'consumption'=> $this->decimal(3, 10)->notNull(),
                'comment'=> $this->string(500)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('resource_id','{{%consumption_norm}}','resource_id',true);
    }

    public function safeDown()
    {
        $this->dropIndex('resource_id', '{{%consumption_norm}}');
        $this->dropTable('{{%consumption_norm}}');
    }
}
