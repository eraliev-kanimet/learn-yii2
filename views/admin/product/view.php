<?php

use app\models\ProductPrice;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\data\ActiveDataProvider $pricesDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);
?>
<div class="product-view">

    <h1>Product: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'contrast pico-color-green-600']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'contrast pico-color-red-600',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div style="margin: 40px 0;">
        <?= Html::a('Create price', ['admin/product-price/create', 'product_id' => $model->id], ['class' => 'contrast pico-color-green-600']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $pricesDataProvider,
        'columns' => [
            'id',
            'product.name',
            'currency.name',
            'value',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, ProductPrice $model) {
                    return Url::to(["admin/product-price/$action", 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>
