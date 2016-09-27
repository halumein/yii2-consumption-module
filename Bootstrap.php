<?php
namespace halumein\consumption;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if(!$app->has('consumption')) {
            $app->set('consumption', ['class' => 'halumein\consumption\Consumption']);
        }

//        if(!$app->has('income')) {
//            $app->set('income', ['class' => 'halumein\consumption\Income']);
//        }

        if (!isset($app->i18n->translations['consumption']) && !isset($app->i18n->translations['consumption*'])) {
            $app->i18n->translations['consumption'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__.'/messagess',
                'forceTranslation' => true
            ];
        }
    }
}
