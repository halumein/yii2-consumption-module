<?php
namespace halumein\consumption;

use halumein\consumption\models\Category;
use halumein\consumption\models\Transaction as TransactionModel;
use halumein\consumption\interfaces\Transaction as TransactionInterface;
use halumein\consumption\models\Resource;
use Yii;


class Transaction implements TransactionInterface
{
    public function init()
    {
        parent::init();
    }

    public function get($id)
    {
        return TransactionModel::findOne($id);
    }

    public function addTransaction($type, $resource_id, $count, $params = null)
    {
        //создаем запись в таблице consumption_transaction
        $model = new TransactionModel();
        $model->type        = $type;
        $model->resource_id = $resource_id;
        $model->count       = $count;
        $model->date        = date("Y-m-d H:i:s");

        $model->ident = 0;
        if (isset($params['ident'])) {
            $model->ident = $params['ident'];
        }

        $model->element_id = 0;
        if (isset($params['element_id'])) {
            $model->element_id = $params['element_id'];
        }

        $model->element_model = "";
        if (isset($params['element_model'])) {
            $model->element_model = $params['element_model'];
        }

        $lastAmount = $model::find()->where(['resource_id' => $resource_id])->orderBy(['date' => SORT_DESC])->one();
        if ($type == 'income') {
            $amount = $lastAmount->amount + $count;
        } elseif ($type == 'outcome'){
            $amount = $lastAmount->amount - $count;
        }
        $model->amount = $amount;
        $model->save();
    }

    public function addByPrice($price, $countPrice, $ident)
    {
        $norms = Yii::$app->norm->getNorms($price);
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;
        foreach ($norms as $norm){
            $params = array('ident' => $ident, 'element_id' => $norm->element_id, 'element_model' => $serviceModel::className());
            $resource_id = $norm->resourceid;
            $count = $norm->consumption * $countPrice;
            $this->addTransaction('outcome', $resource_id, $count, $params);
        }
    }

    /*
    Возвращает массив объектов ActiveRecord отобраный за заданный ident
    ident - поле в таблице comsumption_consume
    */
    public function getByIdent($ident)
    {
        $arrayTransactionByPeriod = TransactionModel::findAll(['ident' => $ident]);
        return $arrayTransactionByPeriod;
    }

    /*
   Возвращает массив объектов ActiveRecord отобраный за заданный период.
   !!Дата передается в формате дд-мм-гггг или дд.мм.гггг!!
   Прим. параметр dateStop необязательный, если его нет то фильр отбирает записи
   только по dateStart
   */
    public function getByPeriod($dateStart, $dateStop = null)
    {
        $transactionByPeriod = TransactionModel::find();

        $dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
        if(!$dateStop) {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStart)+86399);
            $transactionByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
            $transactionByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        } else {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
            $transactionByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
            $transactionByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        }

        $arrayTransactionByPeriod = $transactionByPeriod->all();

        return $arrayTransactionByPeriod;
    }

    /*
   Возвращает Сумму за заданный период.
   !!Дата передается в формате дд-мм-гггг или дд.мм.гггг!!
   Прим. параметр dateStop необязательный, если его нет то фильтр отбирает записи
   только по dateStart, если есть только dateStop, то он игнорируется и считается общая сумма
   */
    public function getSumByPeriod($dateStart, $dateStop)
    {
//        $transactionByPeriod = TransactionModel::find();
//
//        $dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
//        if(!$dateStop) {
//            $dateStop = date('Y-m-d H:i:s', strtotime($dateStart)+86399);
//            $transactionByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
//            $transactionByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
//        } else {
//            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
//            $transactionByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
//            $transactionByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
//        }
//
//        $transactionByPeriod->select('consumption_transaction.count, consumption_resource.base_cost')->leftJoin('consumption_resource', '`consumption_resource`.`id` = `consumption_transaction`.`resource_id`');
//        $sumByPeriod = round($transactionByPeriod->sum('count*base_cost'),2);
//
//        return $sumByPeriod;
    }

    /*
      Возвращает массив объектов ActiveRecord таблицы consumption_transaction по затраченному ресурсу, отобраный за заданный период.
      Первым параметром передается обязательный объект ресурса, 2 и 3 параметры не обязательны(выберутся все записи),
      Если указан только dateStart, то выберутся записи только за этот день.
      Если указан только dateStop, то он будет проигнорирован и выберутся все записи с этим ресурсом.
      !!Дата передается в формате дд-мм-гггг или дд.мм.гггг!!
      Прим. параметр dateStop необязательный, если его нет то фильр отбирает записи
      только по dateStart
     */
    public function getByResource(Resource $resourceModel, $dateStart, $dateStop)
    {

        $transactionByResource = TransactionModel::find();
        $transactionByResource->andWhere(['resource_id' => $resourceModel->id]);
        if($dateStart){
            $dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
            if(!$dateStop) {
                $dateStop = date('Y-m-d H:i:s', strtotime($dateStart)+86399);
                $transactionByResource->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
                $transactionByResource->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
            } else {
                $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
                $transactionByResource->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
                $transactionByResource->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
            }
        }
        $arrayTransactionByResource = $transactionByResource->all();
        return $arrayTransactionByResource;
    }

    public function getByCategory(Category $categoryModel, $dateStart, $dateStop)
    {
        $queryTransactionsByCategory = $categoryModel->getTransactions();
        if($dateStart){
            $dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
            if(!$dateStop) {
                $dateStop = date('Y-m-d H:i:s', strtotime($dateStart)+86399);
                $queryTransactionsByCategory->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
                $queryTransactionsByCategory->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
            } else {
                $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
                $queryTransactionsByCategory->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
                $queryTransactionsByCategory->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
            }
        }
        $arrayTransactionByCategory = $queryTransactionsByCategory->all();
        return $arrayTransactionByCategory;
    }

    public function getMethods()
    {
        return get_class_methods($this);
    }

}
