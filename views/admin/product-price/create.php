<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductPrice $model */
/** @var app\models\Product $product */

$this->title = 'Create price for the product: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
