<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="site-login">
    <h3>News not found</h3>
    <p>
        Seems that the news that you where looking for is not yet calculated. Help us by sending a report on this news so we can verify it for you!
    </p>
    <h4>Report news not found</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'report-new-article-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-4 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <?= $form->field($model, 'url')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'motive')->textarea() ?>
    <?= $form->field($model, 'review')->radioList([0 => 'It\'s unreliable', 25 => 'It\'s mostly unrealible', 50 => 'I don\'t know', 75 => 'It\'s mostrly reliable', 100 => 'It\'s reliable'], ['style' => 'display: block']) ?>
    <div class="form-group">
        <div class="col-lg-11 mt-2">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>