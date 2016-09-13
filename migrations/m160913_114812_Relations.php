<?php

use yii\db\Schema;
use yii\db\Migration;

class m160913_114812_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_consumption_norm_resource_id','{{%consumption_norm}}','resource_id','consumption_resource',
'id');
    }

    public function safeDown()
    {
     $this->dropForeignKey('fk_consumption_norm_resource_id', '{{%consumption_norm}}');
    }
}
