<?php

namespace halumein\consumption\interfaces;

interface Transaction
{
    //параметры для массива(необязательный)
    //[params] = $price - услуга, $ident - ID заказа, $element_model - сервис модель, $element_id - ID сервис модели
    public function addTransaction($type, $resource_id, $count, $params);
}