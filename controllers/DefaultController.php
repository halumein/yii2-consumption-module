<?php

namespace halumein\consumption\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;


/**
 * Default controller for
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


}
