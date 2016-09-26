<?php

namespace halumein\consumption\interfaces;

interface Transaction
{
    public function addForPrice($price, $countPrice, $ident);
    public function addForIncome($resource_id, $count);
}