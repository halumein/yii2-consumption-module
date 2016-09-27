<?php

namespace halumein\consumption\controllers;

use halumein\consumption\models\Category;
use halumein\consumption\models\Resource;
use pistol88\service\models\Price;
use Yii;
use halumein\consumption\models\Transaction;
use halumein\consumption\models\search\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use halumein\consumption\models\Norm;
use pistol88\order\models\Order;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();

        $searchParams = Yii::$app->request->queryParams;
        $searchParams['TransactionSearch']['deleted'] = null;

        $dataProvider = $searchModel->search($searchParams);

//        echo "<pre>";
//        var_dump($dataProvider);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
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
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Transaction();
//
//        if ($model->load(Yii::$app->request->post())) {
//
//            //$serviceModel = $this->module->serviceModel;
//            //$model->element_model = $serviceModel::className();
//
//            $model->date = date("Y-m-d H:i:s");
//            if ($model->save()) {
//                return $this->redirect(['index']);
//            }
//        } else {
//            $serviceModel = $this->module->serviceModel;
//            $services = $serviceModel::find()->all();
//            $resources = Resource::find()->all();
//            return $this->render('create', [
//                'model' => $model,
//                'services' => $services,
//                'resources' => $resources,
//            ]);
//        }
//    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['index']);
//        } else {
//            $serviceModel = $this->module->serviceModel;
//            $services = $serviceModel::find()->all();
//            $resources = Resource::find()->all();
//            return $this->render('update', [
//                'model' => $model,
//                'services' => $services,
//                'resources' => $resources,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Transaction model.
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
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return Action
     */
    public function actionByIdent()
    {
        $get = Yii::$app->request->get();
        $ident = $get['ident'];
        $arrayByIdent =  Yii::$app->consumption->getByIdent($ident);

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
        $arrayTransactionByPeriod =  Yii::$app->consumption->getByPeriod($dateStart, $dateStop);

        echo "<pre>";
        var_dump($arrayTransactionByPeriod);
        die;
        //return $arrayTransactionByPeriod;
    }

    public function actionSumByPeriod()
    {
        $get = Yii::$app->request->get();
        $dateStart = $get['dateStart'];
        $dateStop = $get['dateStop'];
        $sumByPeriod =  Yii::$app->consumption->getSumByPeriod($dateStart, $dateStop);

        echo "<pre>";
        var_dump($sumByPeriod);
        die;
        //return $this->render('index_test');
    }

    public function actionByResource()
    {
        $get = Yii::$app->request->get();
        $dateStart = $get['dateStart'];
        $dateStop = $get['dateStop'];
        $modelResource = Resource::findOne($get['id']);
        $arrayTransactionByResource =  Yii::$app->consumption->getByResource($modelResource, $dateStart, $dateStop);

        echo "<pre>";
        var_dump($arrayTransactionByResource);
        die;
        //return $this->render('index_test');
    }

    public function actionByCategory()
    {
        $get = Yii::$app->request->get();
        $dateStart = $get['dateStart'];
        $dateStop = $get['dateStop'];
        $modelCategory = Category::findOne($get['id']);
        $arrayTransactionByCategory =  Yii::$app->consumption->getByCategory($modelCategory, $dateStart, $dateStop);

        echo "<pre>";
        var_dump($arrayTransactionByCategory);
        die;

    }

    public function actionMethods()
    {
        $arrayMethods =  Yii::$app->consumption->getMethods();

        echo "<pre>";
        var_dump($arrayMethods);
        die;

    }

    public function actionRemains()
    {
        $get = Yii::$app->request->get();
        $id = $get['id'];


        $model = $this->findModel($id);
        $array =  Yii::$app->consumption->setRemainOutcome($model);

        echo "<pre>";
        var_dump($array);
        die;

    }
}
