<?php

namespace halumein\consumption\interfaces;

interface Cost
{
    public function addCost($transaction_id, $income_id, $consume_amount, $date);
    public function updCost($costModel, $income_id, $consume_amount);
}