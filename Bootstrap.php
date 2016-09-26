<?php
namespace halumein\consumption;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if(!$app->has('transaction')) {
            $app->set('transaction', ['class' => 'halumein\consumption\Transaction']);
        }

        if(!$app->has('norm')) {
            $app->set('norm', ['class' => 'halumein\consumption\Norm']);
        }

        if(!$app->has('income')) {
            $app->set('income', ['class' => 'halumein\consumption\Income']);
        }

        if (!isset($app->i18n->translations['consumption']) && !isset($app->i18n->translations['consumption*'])) {
            $app->i18n->translations['consumption'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__.'/messagess',
                'forceTranslation' => true
            ];
        }
    }
}
