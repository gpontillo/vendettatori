<?php

use app\models\Segnalazioni;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="segnalazioni-form">

    <?php $form = ActiveForm::begin([
        'id' => 'segnalazioni-moderator-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-4 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'disabled' => true])  ?>

    <?=  $form->field($model, 'motivo')->textarea(['maxlength' => true, 'disabled' => true])   ?>

    <?= $form->field($model, 'valutazione')->dropdownList(
        Segnalazioni::VALUTAZIONI_ARRAY, 
        ['disabled' => true]
    ) ?>

    <?= $form->field($model, 'esito')->dropdownList(
        Segnalazioni::ESITO_ARRAY
    ) ?>

    <div class="form-group">
        <div class="col-lg-11 mt-2">
            <?= Html::submitButton('Save your verdict', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>