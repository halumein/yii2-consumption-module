<?php

use yii\db\Schema;
use yii\db\Migration;

class m160913_063011_consumption_resource extends Migration
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
            '{{%consumption_resource}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull(),
                'dimension'=> $this->decimal(3, 10)->notNull()->defaultValue('0.000'),
                'measures'=> $this->string(100)->notNull(),
                'base_unit'=> $this->decimal(3, 10)->notNull()->defaultValue('0.000'),
                'comment'=> $this->string(500)->notNull(),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consumption_resource}}');
    }
}
