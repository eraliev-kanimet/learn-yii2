<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionError(): string
    {
        return $this->render(
            'error',
            ['exception' => Yii::$app->errorHandler->exception]
        );
    }
}
