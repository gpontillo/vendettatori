<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\model\Notizia;
use app\models\Fonte;

?>
<div class="site-contact">
    <div class="row">
        <div class="col">
            <h2>Search sources</h2>
            <p>
                With this form, you can search for a source and see if it's affidable or not.
                Just insert the name the source to search it.
                If we can't calculate affidability of the source, you will be asked to send us a report of the source and one of our moderator will analise it.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Search by Name</h4>
            <?php $form = ActiveForm::begin([
                'id' => 'calculate-source-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-4 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>
            <?= $form->field($model, 'source') ?>
            <div class="form-group">
                <div class="col-lg-11 mt-2">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'margin-left: -12px']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>
