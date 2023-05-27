<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Segnalazioni;

/** @var yii\web\View $this */
/** @var app\models\SegnalazioniSearch $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="segnalazioni-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'motivo') ?>

    <?= $form->field($model, 'valutazione')->dropdownList(
        Segnalazioni::VALUTAZIONI_ARRAY
    ) ?>
    
    <?= $form->field($model, 'esito')->dropdownList(
        Segnalazioni::ESITO_ARRAY
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
