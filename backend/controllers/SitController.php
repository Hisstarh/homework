<?php

namespace backend\controllers;

class SitController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
