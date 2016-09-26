<?php

namespace halumein\consumption\interfaces;

interface Income
{
    //реализован но не работает так как убрали поле баланс
    public function getBalance($resource_id);
}