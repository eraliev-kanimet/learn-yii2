<?php

namespace app\controllers\admin;

use app\models\Currency;
use app\models\CurrencyRate;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CurrencyController extends Controller
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

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Currency::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $ratesDataProvider = new ActiveDataProvider([
            'query' => CurrencyRate::find()->where(['currency_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'ratesDataProvider' => $ratesDataProvider,
        ]);
    }

    public function actionCreate(): Response|string
    {
        $model = new Currency();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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
            return $this->redirect(['view', 'id' => $model->id]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Currency
    {
        if (($model = Currency::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
