<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users\' reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Report infos'];
\yii\web\YiiAsset::register($this);
?>
<div class="segnalazioni-view">

    <h1><?= Html::encode('Report infos') ?></h1>

    <p>
        <?= Html::a('Choose a verdict', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete report', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'url:url',
            'motivo',
            'valutazione',
            'esito'
        ],
    ]) ?>

</div>
