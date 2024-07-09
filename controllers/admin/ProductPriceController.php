<?php

namespace app\controllers\admin;

use app\models\Product;
use app\models\ProductPrice;
use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ProductPriceController extends Controller
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
    public function actionCreate($product_id): Response|string
    {
        $model = new ProductPrice();
        $product = $this->findProduct($product_id);

        if ($this->request->isPost) {
            $data = $this->request->post();
            $data['ProductPrice']['product_id'] = $product->id;

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['admin/product/view', 'id' => $model->product_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'product' => $product,
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
            return $this->redirect(['admin/product/view', 'id' => $model->product_id]);
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
        $price = $this->findModel($id);

        $product_id = $price->product_id;

        $price->delete();

        return $this->redirect(['admin/product/view', 'id' => $product_id]);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ProductPrice
    {
        if (($model = ProductPrice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findProduct($id): Product
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
