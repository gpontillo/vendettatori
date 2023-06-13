<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\model\Notizia;
use yii\model\Fonte;

?>
<div class="site-contact">
    <?php
    if (Yii::$app->request->get('success') != null) {
        echo '
            <div class="alert alert-success" role="alert">
                Report sent with success!
            </div>
          ';
    }
    ;
    ?>
    <div class="row">
        <div class="col">
            <h2>Search news</h2>
            <p>
                With this form, you can search for an article and see if it's affidable or not.
                Just insert the url or a media of the article to search it.
                If we can't calculate affidability of the article, you will be asked to send us a report of the article
                and one of our moderator will analise it.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Search by URL</h4>
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
            <?= $form->field($model, 'url') ?>
            <div class="form-group">
                <div class="col-lg-11 mt-2">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'margin-left: -12px']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>