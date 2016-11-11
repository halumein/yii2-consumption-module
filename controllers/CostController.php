<?php

namespace halumein\consumption\controllers;

use halumein\consumption\models\search\CostSearch;
use Yii;
use halumein\consumption\models\Cost;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CostController implements the CRUD actions for Cost model.
 */
class CostController extends Controller
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
     * Lists all Cost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CostSearch();

        $searchParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($searchParams);

        // ниже считаем расходы по каждому приходу
        $unicIncomeSearch = $searchModel->search($searchParams);

        // сначала выберем уникальные идешники приходов
        $incomeIds = $unicIncomeSearch->query->select('income_id')->distinct()->all();
        unset($unicIncomeSearch);
        $totalConsume = [];

        // теперь для каждого идешника найдём имя ресурса и посчитаем общее количество использования
        foreach ($incomeIds as $key => $model) {
            $incomeConsumeSumSearch = $searchModel->search($searchParams);;

            // всё слепим в массив, и так отдадим на вьюху
            // TODO сделать что бы одинаковые ресурсы с разных инкамов суммировались
            $totalConsume[] = [
                'resource' => $model->income->resource->name,
                'consumeAmount' => $incomeConsumeSumSearch->query
                    ->andWhere(['income_id' => $model->income->id])
                    ->sum('consume_amount')
            ];
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'totalConsume' => $totalConsume
        ]);
    }

    public function actionProblem()
    {
        $searchModel = new CostSearch();

        $searchParams = Yii::$app->request->queryParams;
        $searchParams['CostSearch']['income_id'] = null;

        $dataProvider = $searchModel->search($searchParams);

        return $this->render('problem', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResolveProblem()
    {
        if ($postData = Yii::$app->request->post('costIds')) {
            if (count($postData) > 0) {
                $arrNullCosts = Cost::find()->where(['id' => $postData])->all();
                foreach ($arrNullCosts as $nullCostModel){
                    Yii::$app->consumption->setNullCost($nullCostModel);
                }
                $this->redirect('problem');
            } else {
                $this->redirect('problem');
            }
        } else {
            $this->redirect('problem');
            Yii::$app->getSession()->setFlash('error', "Не выборано ни одной строки!");
        }


    }

    /**
     * Finds the Cost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNullupdate()
    {
        $get = Yii::$app->request->get();
        $id = $get['id'];


        $model = $this->findModel($id);
//        echo "<pre>";
//        var_dump($model);
//        die;
        $array =  Yii::$app->consumption->setNullCost($model);

        return true;


    }
}
