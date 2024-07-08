<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionError(): string
    {
        $exception = Yii::$app->errorHandler->exception;

        return $this->render('error', ['exception' => $exception]);
    }
}
