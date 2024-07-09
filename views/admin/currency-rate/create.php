<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CurrencyRate $model */
/** @var app\models\Currency $currency */

$this->title = 'Create rate for the currency: ' . $currency->name;
$this->params['breadcrumbs'][] = ['label' => 'Currency Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
