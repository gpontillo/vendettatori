<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */

$this->title = 'Create Segnalazioni';
$this->params['breadcrumbs'][] = ['label' => 'Users\'reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="segnalazioni-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
