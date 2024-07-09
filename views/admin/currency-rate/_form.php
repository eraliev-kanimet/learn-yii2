<?php

use app\models\Currency;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CurrencyRate $model */
/** @var yii\widgets\ActiveForm $form */

$currencies = Currency::find()->select(['name', 'id'])->indexBy('id')->column()
?>

<div class="currency-rate-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'errorOptions' => [
                'class' => 'pico-color-red-600',
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencies, ['prompt'=>'Select currency']) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
