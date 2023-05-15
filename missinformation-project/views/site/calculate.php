<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\model\Categoria;
use yii\model\Notizia;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url') ?>
    

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'category')->dropdownList([
        1 => 'Sport', 
        2 => 'Cronaca'
    ],
    ['prompt'=>'Select Category']

    );?>
    

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

