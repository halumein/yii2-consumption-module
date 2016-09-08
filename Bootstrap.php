<?php
namespace halumein\consumption;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if (!isset($app->i18n->translations['consumption']) && !isset($app->i18n->translations['consumption*'])) {
            $app->i18n->translations['consumption'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__.'/messagess',
                'forceTranslation' => true
            ];
        }
    }
}
