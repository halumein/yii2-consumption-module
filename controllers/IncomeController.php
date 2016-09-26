<?php

namespace halumein\consumption\controllers;

use halumein\consumption\models\Resource;
use Yii;
use halumein\consumption\models\Income;
use halumein\consumption\models\search\IncomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncomeController implements the CRUD actions for Income model.
 */
class IncomeController extends Controller
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
     * Lists all Income models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $resources = Resource::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'resources' => $resources,
        ]);
    }

    /**
     * Displays a single Income model.
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
     * Creates a new Income model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Income();

        if ($model->load(Yii::$app->request->post())){
            $model->balance = Yii::$app->request->post()["Income"]["income"];
            $model->date = date("Y-m-d H:i:s");
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $resources = Resource::find()->all();
            return $this->render('create', [
                'model' => $model,
                'resources' => $resources,
            ]);
        }
    }

    /**
     * Updates an existing Income model.
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
            $resources = Resource::find()->all();
            return $this->render('update', [
                'model' => $model,
                'resources' => $resources,
            ]);
        }
    }

    /**
     * Deletes an existing Income model.
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
     * Finds the Income model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Income the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Income::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionByResource()
    {
        $get = Yii::$app->request->get();
        $resource_id = $get['resource_id'];
        $arrayByResource =  Yii::$app->income->getBalance($resource_id);

        echo "<pre>";
        //var_dump($arrayByResource);
        print_r($arrayByResource);
        die;
        //return $arrayByIdent;
    }
}
