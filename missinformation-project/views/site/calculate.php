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
            <h2>Search news</h2>
            <p>
                With this form, you can search for an article and see if it's affidable or not.
                Just insert the url or a media of the article to search it.
                If we can't calculate affidability of the article, you will be asked to send us a report of the article and one of our moderator will analise it.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Search by URL</h4>
            <?php $form = ActiveForm::begin(); ?>
            <div class="mb-3">
                <?= $form->field($model, 'url') ?>
            </div>
            <div class="mb-3">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col">
            <h4>Search by media</h4>
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="button">Submit</button>
            </div>
        </div>
    </div>
</div>