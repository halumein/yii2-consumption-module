<?php

namespace halumein\consumption\controllers;

use halumein\consumption\models\Resource;
use Yii;
use halumein\consumption\models\Norm;
use halumein\consumption\models\search\NormSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NormController implements the CRUD actions for Norm model.
 */
class NormController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Norm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Norm model.
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
     * Creates a new Norm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Norm();

        if ($model->load(Yii::$app->request->post())) {
            $serviceModel = $this->module->serviceModel;
            $model->element_model = $serviceModel::className();
            //ищем есть ли модель с такими парамтерами, если есть то апдейт, если нет то новая
            $searchForUpd = $this->findForUpd($model);
            if ($searchForUpd !== null) {
                $searchForUpd->load(Yii::$app->request->post());
                if ($searchForUpd->save()) {
                    $model->element_model = $serviceModel::className();
                    return $this->redirect(['index']);
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
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
     * Updates an existing Norm model.
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
     * Deletes an existing Norm model.
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
     * Finds the Norm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Norm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Norm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findForUpd($model)
    {
        if (($model = Norm::find()->where(['element_model' => $model->element_model, 'element_id' => $model->element_id, 'resource_id' => $model->resource_id])->one()) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
