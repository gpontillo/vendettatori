<?php
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center title-card bypass-container" style="margin-top: -20px;">
        <div class="title-card-inside">
        <div class="row">
            <div class="col col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4">Welcome to the Missinformation Fight!</h1>
                <p class="lead fw-normal">You hate fake news? This is your resolve.</p>
            </div>
        </div>
        </div>
    </div>
    <div class="body-content">
        <div class="row margin-rows-index card-index-page">
            <div class="col gx-5" style="padding-left: 0px">
                <?= Html::img(Yii::$app->request->baseUrl.'/resources/images/fakenews.png', ["class" => "image-card"]);?>
            </div>
            <div class="col d-flex flex-column justify-content-center gx-5">
                <h3>Searching News</h3>
                <p>
                    You can insert every kind of news on our site.
                    Videos, Textual news, and Images, it doesn't matter
                    what you want to search, we can say to you if it's
                    reliable or not.
                </p>
                <p><?= Html::a('Try it now!', ['/site/calculate'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
        </div>
        <div class="row margin-rows-index card-index-page">
            <div class="col d-flex flex-column justify-content-center p-3 gx-5">
                <h3>Report News</h3>
                <p>
                    You can report to our site every kind of news with a specific form, it will helps
                    us to increase our news database in order to evaluate the reliability about it.
                </p>
            </div>
            <div class="col gx-5" style="padding-right: 0px">
                <?= Html::img(Yii::$app->request->baseUrl.'/resources/images/report.png', ["class" => "image-card alternate-shadow"]);?>
            </div>
        </div>
        <div class="row margin-rows-index card-index-page">
            <div class="col gx-5" style="padding-left: 0px">
                <?= Html::img(Yii::$app->request->baseUrl.'/resources/images/moderator.png', ["class" => "image-card"]);?>
            </div>
            <div class="col d-flex flex-column justify-content-center p-3 gx-5">
                <h3>Moderators</h3>
                <p>Our moderators team have a constant look
                    to our databases in order to look in something
                    that doesn't go.</p>
            </div>
        </div>
    </div>
</div>