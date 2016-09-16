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

    public function getSumByPeriod($dateStart, $dateStop)
    {
        if($dateStart = yii::$app->request->get('date_start')) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
        }

        if($dateStop = yii::$app->request->get('date_stop')) {
            $dateStop = date('Y-m-d', strtotime($dateStop));
        }

        $sql = 'SELECT * FROM consumption_consume WHERE ident=:ident';
        $arrayConsumeByPeriod = ConsumeModel::findBySql($sql, [':ident' => 0])->all();
        var_dump($arrayConsumeByPeriod);
        die;

        //->andWhere('date > :dateStart', 'date < :dateStop' [':dateStart' => $dateStart, ':dateStop' => $dateStop])->all();
        $sumByPeriod = 1;
        return $sumByPeriod;
    }

    public function getByIdent($ident)
    {
        $sql = 'SELECT * FROM consumption_consume WHERE ident=:ident';
        $arrayConsumeByPeriod = ConsumeModel::findBySql($sql, [':ident' => $ident])->all();

        return $arrayConsumeByPeriod;
    }
}
