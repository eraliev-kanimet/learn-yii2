<?php

namespace app\controllers\admin;

use app\models\Currency;
use app\models\CurrencyRate;
use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class CurrencyRateController extends Controller
{
    public $layout = 'admin';

    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionCreate($currency_id): Response|string
    {
        $model = new CurrencyRate();
        $currency = $this->findCurrency($currency_id);

        if ($this->request->isPost) {
            $data = $this->request->post();
            $data['CurrencyRate']['currency_id'] = $currency_id;

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['admin/currency/view', 'id' => $currency_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'currency' => $currency,
        ]);
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['admin/currency/view', 'id' => $model->currency_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $rate = $this->findModel($id);

        $currency_id = $rate->currency_id;

        $rate->delete();

        return $this->redirect(['admin/currency/view', 'id' => $currency_id]);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?CurrencyRate
    {
        if (($model = CurrencyRate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findCurrency($id): Currency
    {
        if (($model = Currency::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
