<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\model\Categoria;
use yii\model\Notizia;
use yii\model\Fonte;
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
            <?php $form = ActiveForm::begin(); ?>
            <div class="mb-3">
                <?= $form->field($model, 'source') ?>
            </div>
            <div class="mb-3">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>