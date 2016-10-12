<?php

namespace halumein\consumption;

class Module extends \yii\base\Module
{
    public $serviceModel;
    public $adminRoles = ['superadmin', 'admin'];
    public $userModel = '\common\models\User';

    public function init()
    {
        parent::init();
    }

}
