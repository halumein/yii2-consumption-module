<?php
namespace halumein\consumption;

use halumein\consumption\models\Income as IncomeModel;
use halumein\consumption\interfaces\Income as IncomeInterface;

class Income implements IncomeInterface
{
    public function getBalance($resource_id)
    {
        $incomes = IncomeModel::find()->where(['resource_id' => $resource_id])->all();
        $totalCount = 0;
        $byIncomes = [];
        foreach ($incomes as $income){
            $totalCount = $totalCount + $income->balance;
            $byIncomes[$income->id] = $income->balance;
        }
        $returnArray = array('totalCount' => $totalCount, 'byIncomes' => $byIncomes);
        return $returnArray;
    }
}