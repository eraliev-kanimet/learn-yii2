<?php

use app\models\Currency;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductPrice $model */
/** @var yii\widgets\ActiveForm $form */

$currencies = Currency::find()->select(['name', 'id'])->indexBy('id')->column();
?>

<div class="product-price-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'errorOptions' => [
                'class' => 'pico-color-red-600',
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencies, ['prompt'=>'Select currency']) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
