<?php

namespace halumein\consumption\controllers;

use Yii;
use halumein\consumption\models\Consume;
use halumein\consumption\models\search\ConsumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
            $model->order_model = Order::className();

            $serviceModel = $this->module->serviceModel;
            $model->element_model = $serviceModel::className();

            $model->date = date("Y-m-d H:i:s");
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
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
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        $model = new Consume();

        $get = Yii::$app->request->get();

        $model->element_id = $get['element_id'];
        $model->norm_id = $get['norm_id'];
        $model->order_id = $get['order_id'];

        $model->order_model = Order::className();

        $serviceModel = $this->module->serviceModel;
        $model->element_model = $serviceModel::className();

        $model->date = date("Y-m-d H:i:s");
        if ($model->save()) {
            return $this->redirect(['index']);
        }

    }
}
