<?php

use app\models\Purchase;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Purchase', ['create'], ['class' => 'contrast pico-color-green-600']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'product.name',
            'name',
            'phone',
            'amount',
            'payment_status' => [
                'format' => 'raw',
                'value' => fn(Purchase $model) => $model->payment_status ? 'Paid' : 'Not Paid',
                'contentOptions' => function (Purchase $model) {
                    return [
                        'class' => $model->payment_status ? 'pico-color-green-600' : 'pico-color-red-600',
                    ];
                },
            ],
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Purchase $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
