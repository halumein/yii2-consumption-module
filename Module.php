<?php

namespace halumein\consumption;

class Module extends \yii\base\Module
{
    public $serviceModel;
    public $userForConsumption = '\common\models\User';

    public function init()
    {
        parent::init();
    }

}
