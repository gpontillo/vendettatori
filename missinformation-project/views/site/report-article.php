<?php

use app\models\Segnalazioni;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="site-login">
    <h3>Report news</h3>
    <p>
        Compile this form to give us the information to review your report about this news. Thank you for your time!
        (If you searched for a news and you see thi page, it means that the news that you searched is not in our db)
    </p>
    <h4>Report news form</h4>

    <?php $form = ActiveForm::begin([
        'id' => 'report-article-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-4 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <?= $form->field($model, 'url')->textInput(['autofocus' => true, 'disabled' => true]) ?>
    <?= $form->field($model, 'motive')->textarea() ?>
    <?=
    $form->field($model, 'review')->radioList(
        Segnalazioni::VALUTAZIONI_ARRAY,
        ['style' => 'display: block']
    )
    ?>
    <div class="form-group">
        <div class="col-lg-11 mt-2">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>