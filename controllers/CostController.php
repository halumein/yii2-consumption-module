<?php

namespace halumein\consumption\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use halumein\consumption\models\Cost;
use halumein\consumption\models\Resource;
use halumein\consumption\models\search\CostSearch;
use halumein\consumption\models\search\TransactionSearch;

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
        // находим все транзакции (с фильтром, если задан) и сгруппируем их
        // по элементам заказов, что бы найти все расходы на каждый элемент заказа
        $searchModel = new TransactionSearch();
        $searchParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($searchParams);
        $dataProvider->query
            ->andWhere(['!=', 'ident', 0])
            ->andWhere(['deleted' => NULL])
            ->andWhere(['type' => 'outcome'])
            ->groupBy(['ident', 'element_model', 'element_id']);

        if (Yii::$app->request->getQueryParam('resource_id')) {
            $dataProvider->query->andWhere(['resource_id' => Yii::$app->request->getQueryParam('resource_id')]);
        }

        $resourceList = Resource::find()->all();

        // отдельно посчитаем общую стоимость всех расходов
        $costSearch = new CostSearch();
        $costProvider = $costSearch->search(Yii::$app->request->queryParams);
        $costProvider->setPagination(false);
        $totalCost = number_format(array_sum(ArrayHelper::getColumn($costProvider->getModels(), 'consumeCost')), 2, ',', ' ');

        $costs = $costProvider->getModels();



        // посчитаем общие количественные расходы по ресурсам
        $totalConsume = [];
        foreach ($costs as $key => $cost) {
            if (!isset($consumeCounter[$cost->transaction->resource->id])) {
                $consumeCounter[$cost->transaction->resource->id] = 0;
            } else {
                $consumeCounter[$cost->transaction->resource->id] += $cost->consume_amount;
            }

            $totalConsume[$cost->transaction->resource->id] = [
                    'resource' => $cost->transaction->resource->name,
                    'consumeAmount' => $consumeCounter[$cost->transaction->resource->id]
                ];
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'totalCost' => $totalCost,
            'totalConsume' => $totalConsume,
            'resourceList' => $resourceList,
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
