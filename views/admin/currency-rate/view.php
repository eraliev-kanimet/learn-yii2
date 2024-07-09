<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\CurrencyRate $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Currency Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);
?>
<div class="currency-rate-view">

    <h1>Currency Rate: <?= Html::encode($this->title) ?></h1>

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
            'currency.name',
            'rate',
            'date',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
