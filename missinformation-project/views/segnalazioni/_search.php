<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SegnalazioniSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="segnalazioni-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'motivo') ?>

    <?= $form->field($model, 'valutazione') ?>
    
    <?= $form->field($model, 'esito') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
