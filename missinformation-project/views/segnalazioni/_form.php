<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="segnalazioni-form">

    <?php $form = ActiveForm::begin(); ?>

     <!-- $form->field($model, 'url')->textInput(['maxlength' => true]) 

     $form->field($model, 'motivo')->textInput(['maxlength' => true]) 

     $form->field($model, 'valutazione')->textInput()  -->
    
    <?= $form->field($model, 'esito')->dropdownList([
        'Reliable' => 'Reliable', 
        'Not Reliable' => 'Not reliable'
    ],
    ['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save your verdict', ['class' => 'btn btn-success', 'style' => 'margin-top: 15px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
