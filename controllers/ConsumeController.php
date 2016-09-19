<?php

namespace halumein\consumption\controllers;

use halumein\consumption\models\Resource;
use pistol88\service\models\Price;
use Yii;
use halumein\consumption\models\Consume;
use halumein\consumption\models\search\ConsumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use halumein\consumption\models\Norm;
use pistol88\order\models\Order;

/**
 * ConsumeController implements the CRUD actions for Consume model.
 */
class ConsumeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Consume models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConsumeSearch();

        $searchParams = Yii::$app->request->queryParams;
        $searchParams['ConsumeSearch']['deleted'] = null;


        $dataProvider = $searchModel->search($searchParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Consume model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Consume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Consume();

        if ($model->load(Yii::$app->request->post())) {

            //$serviceModel = $this->module->serviceModel;
            //$model->element_model = $serviceModel::className();

            $model->date = date("Y-m-d H:i:s");
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $serviceModel = $this->module->serviceModel;
            $services = $serviceModel::find()->all();
            $resources = Resource::find()->all();
            return $this->render('create', [
                'model' => $model,
                'services' => $services,
                'resources' => $resources,
            ]);
        }
    }

    /**
     * Updates an existing Consume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $serviceModel = $this->module->serviceModel;
            $services = $serviceModel::find()->all();
            $resources = Resource::find()->all();
            return $this->render('update', [
                'model' => $model,
                'services' => $services,
                'resources' => $resources,
            ]);
        }
    }

    /**
     * Deletes an existing Consume model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = date('Y:m:d H:i:s', time());
        if ($model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/error', [
                'error' => $model->errors
            ]);
        }
    }

    /**
     * Finds the Consume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Consume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Consume::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateget()
    {
        $get = Yii::$app->request->get();
        $serviceModel = $this->module->serviceModel;
        $order = Yii::$app->order->get($get['order_id']);

        $elements = $order->getElements();
        foreach ($elements as $element){
                $price = $element->getModel();
                $norms = Yii::$app->norm->getNorms($price);

                foreach ($norms as $norm){
                    $model = new Consume();
                    $model->ident           = $get['order_id'];
                    $model->element_id      = $norm->element_id;
                    $model->element_model   = $serviceModel::className();
                    $model->resource_id     = $norm->resourceid;
                    $model->consume         = $norm->consumption;
                    $model->date            = date("Y-m-d H:i:s");
                    $model->save();
                }
        }
        return $this->redirect(['index']);
    }

    /**
     * @return Action
     */
    public function actionByIdent()
    {
        $get = Yii::$app->request->get();
        $ident = $get['ident'];
        $arrayByIdent =  Yii::$app->consume->getByIdent($ident);

        echo "<pre>";
        var_dump($arrayByIdent);
        die;
        //return $arrayByIdent;
    }

    public function actionByPeriod()
    {
        $get = Yii::$app->request->get();
        $dateStart = $get['dateStart'];
        $dateStop = $get['dateStop'];
        $arrayConsumeByPeriod =  Yii::$app->consume->getByPeriod($dateStart, $dateStop);

        echo "<pre>";
        var_dump($arrayConsumeByPeriod);
        die;
        //return $arrayConsumeByPeriod;
    }

    public function actionSumByPeriod()
    {
        $get = Yii::$app->request->get();
        $dateStart = $get['dateStart'];
        $dateStop = $get['dateStop'];
        $sumByPeriod =  Yii::$app->consume->getSumByPeriod($dateStart, $dateStop);

        echo "<pre>";
        var_dump($sumByPeriod);
        die;
        //return $this->render('index_test');
    }
}
