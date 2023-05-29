<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */

$this->title = 'Update report: ';
$this->params['breadcrumbs'][] = ['label' => 'Users\' reports', 'url' => ['segnalazioni/index']];
$this->params['breadcrumbs'][] = ['label' => 'Report infos', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Report\'s verdict';
?>
<div class="segnalazioni-update">

    <h1><?= Html::encode("Choose your verdict") ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
