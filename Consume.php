<?php
namespace halumein\consumption;

use halumein\consumption\models\Consume as ConsumeModel;
use halumein\consumption\interfaces\Consume as ConsumeInterface;
use Yii;


class Consume implements ConsumeInterface
{
    public function init()
    {
        parent::init();
    }

    public function get($id)
    {
        return ConsumeModel::findOne($id);
    }

    public function add($price, $ident)
    {
        //создаем запись в таблице consumes
        $norms = Yii::$app->norm->getNorms($price);
        $serviceModel = Yii::$app->getModule('consumption')->serviceModel;
        foreach ($norms as $norm){
            $model = new ConsumeModel();
            $model->ident           = $ident;
            $model->element_id      = $norm->element_id;
            $model->element_model   = $serviceModel::className();
            $model->resource_id     = $norm->resourceid;
            $model->consume         = $norm->consumption;
            $model->date            = date("Y-m-d H:i:s");
            $model->save();
        }
    }

    /*
    Возвращает массив объектов ActiveRecord отобраный за заданный ident
    ident - поле в таблице comsumption_consume
    */
    public function getByIdent($ident)
    {
        $arrayConsumeByPeriod = ConsumeModel::findAll(['ident' => $ident]);
        return $arrayConsumeByPeriod;
    }

    /*
   Возвращает массив объектов ActiveRecord отобраный за заданный период.
   !!Дата передается в формате дд-мм-гггг или дд.мм.гггг!!
   Прим. параметр dateStop необязательный, если его нет то фильр отбирает записи
   только по dateStart
   */
    public function getByPeriod($dateStart, $dateStop)
    {
        $ConsumeByPeriod = ConsumeModel::find();

        $dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
        if(!$dateStop) {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStart)+86399);
            $ConsumeByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
            $ConsumeByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
            //$ConsumeByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart], 'date <= :dateStop', [':dateStop' => $dateStop]);
        } else {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
            $ConsumeByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
            $ConsumeByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        }

        $arrayConsumeByPeriod = $ConsumeByPeriod->all();

        return $arrayConsumeByPeriod;
    }

    /*
   Возвращает массив объектов ActiveRecord отобраный за заданный период.
   !!Дата передается в формате дд-мм-гггг или дд.мм.гггг!!
   Прим. параметр dateStop необязательный, если его нет то фильр отбирает записи
   только по dateStart
   */
    public function getSumByPeriod($dateStart, $dateStop)
    {
        $consumeByPeriod = ConsumeModel::find();

        $dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
        if(!$dateStop) {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStart)+86399);
            $consumeByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
            $consumeByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        } else {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
            $consumeByPeriod->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
            $consumeByPeriod->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        }

        $consumeByPeriod->select('consumption_consume.consume, consumption_resource.base_cost')->leftJoin('consumption_resource', '`consumption_resource`.`id` = `consumption_consume`.`resource_id`');
        $sumByPeriod = round($consumeByPeriod->sum('consume*base_cost'),2);

        return $sumByPeriod;
    }
}
