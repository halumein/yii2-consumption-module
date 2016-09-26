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

В модуль Order добавить обработку, которая отработает при создании нового заказа

,,,

'modules' => [

    'order' => [
    
        ...
    
        'on create' => function($event) {
            $order = $event->model;
        
            $ident  = $order->id;
            $elements = $order->getElements();
        
            foreach ($elements as $element) {
                $countPrice = $element->count;
                $price = $element->getModel();
                Yii::$app->transaction->addForPrice($price, $countPrice, $ident);
            }
        }
    
        ...
   
    ]
]
,,,            

дальше обращаться по адресу consumption/<имя_контроллера>
