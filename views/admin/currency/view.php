<?php

use app\models\CurrencyRate;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Currency $model */
/** @var yii\data\ActiveDataProvider $ratesDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);
?>
<div class="currency-view">

    <h1>Currency: <?= Html::encode($this->title) ?></h1>

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
            'code',
            'name',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div style="margin: 40px 0;">
        <?= Html::a('Create rate', ['admin/currency-rate/create', 'currency_id' => $model->id], ['class' => 'contrast pico-color-green-600']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $ratesDataProvider,
        'columns' => [
            'id',
            'rate',
            'date',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, CurrencyRate $model) {
                    return Url::to(["admin/currency-rate/$action", 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>
