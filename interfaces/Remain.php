<?php

namespace halumein\consumption\interfaces;

interface Remain
{
    public function addRemain($income);
    public function setRemainOutcome($transaction);
}