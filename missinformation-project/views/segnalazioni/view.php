<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Segnalazioni;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users\' reports', 'url' => ['segnalazioni/index']];
$this->params['breadcrumbs'][] = ['label' => 'Report infos'];
\yii\web\YiiAsset::register($this);
?>
<div class="segnalazioni-view">

    <h1><?= Html::encode('Report\'s infos') ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'url:url',
            'motivo',
            (
                empty($model->media_path) && $model->valutazione > -1 ?
                [
                    'attribute' => 'valutazione',
                    'value' => function ($model) {
                        return Segnalazioni::getValutazione($model->valutazione);
                    }
                ]
                :
                [
                    'attribute' => 'Media',
                    'value' => function ($model) {
                        return Html::a('See media', Yii::getAlias('@webroot').$model->media_path, ['target'=>'_blank']);
                    },
                    'format' => 'raw'
                ]
            ),
            [
                'attribute' => 'esito',
                'value' => function ($model) {
                    return Segnalazioni::getEsito($model->esito);
                }
            ]
        ],
    ]) ?>

    <?php
    if ($news != null) {
        echo '
                <h4>Report\'s news</h4>
            ';
        echo '<div class="col-6">';
        echo DetailView::widget([
            'model' => $news,
            'attributes' => [
                'descrizione_notizia',
                'indice_attendibilita',
                'data_pubblicazione',
                'data_accaduto',
            ],
        ]);
        echo '</div>';
    }
    ?>

    <p>

        <?php if (empty($model->media_path) && $model->valutazione > -1) : ?>
            <?= Html::a('Choose a verdict', $model->esito == 0 ? ['update', 'id' => $model->id] : "", ['class' => $model->esito == 0 ? 'btn btn-primary' : 'btn btn-primary disabled']) ?>
        <?php else : ?>
            <?= Html::a('Accept media', $model->esito == 0 ? ['accept-media', 'id' => $model->id] : "", ['class' => $model->esito == 0 ? 'btn btn-primary' : 'btn btn-primary disabled']) ?>
        <?php endif; ?>
        <?= Html::a('Go back', ['index'], ['class' => 'btn btn-danger']) ?>
    </p>

</div>