<?php

namespace halumein\consumption;

class Module extends \yii\base\Module
{
    public $serviceModel;
    public $adminRoles = ['superadmin', 'admin'];
    public $userModel = '\common\models\User';
    public $menu = [
            [
                'label' => 'Категории',
                'url' => ['/consumption/category/index'],
            ],
            [
                'label' => 'Расходники',
                'url' => ['/consumption/resource/index'],
            ],
            [
                'label' => 'Нормы',
                'url' => ['/consumption/norm/index'],
            ],
            [
                'label' => 'Расходы',
                'url' => ['/consumption/cost/index'],
            ],
            [
                'label' => 'Остатки',
                'url' => ['/consumption/income/index'],
            ],
        ];


    public function init()
    {
        parent::init();
    }

}
