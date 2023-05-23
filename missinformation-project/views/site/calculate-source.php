<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\model\Categoria;
use yii\model\Notizia;
use yii\model\Fonte;
?>
<div class="site-contact">
    <?php $form1 = ActiveForm::begin(); ?>
    <div class="mb-3">
        <?= $form1->field($model, 'source') ?>
    </div>
    <div class="mb-3">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>