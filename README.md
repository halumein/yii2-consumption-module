Yii2-consumption-module
==========


```
php composer require halumein/yii2-consumption-module "*"
```

миграции:

```
php yii migrate --migrationPath=vendor/halumein/yii2-consumption-module/migrations
```

В конфигурационный файл приложения добавить модуль cashbox

```php
    'modules' => [
        'consumption' => [
            'class' => 'halumein\consumption\Module',
        ],
        //...
    ]
```

дальше обращаться по адресу consumption/<имя_контроллера>
