<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\model\Categoria;
use yii\model\Notizia;
?>
<div class="site-contact">
    <?php $form = ActiveForm::begin(); ?>
    <div class="mb-3">
        <?= $form->field($model, 'url') ?>
    </div>
    <div class="mb-3">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="mb-3">
        <?=
        $form->field($model, 'category')->dropdownList(
            [
                1 => 'Sport',
                2 => 'Cronaca'
            ],
            ['prompt' => 'Select Category']

        ); ?>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>