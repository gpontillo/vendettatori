<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Segnalazioni;

/** @var yii\web\View $this */
/** @var app\models\Segnalazioni $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users\' reports', 'url' => ['index']];
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
            [
                'attribute' => 'valutazione',
                'value' => function($model){
                    return Segnalazioni::getValutazione($model->valutazione);
                }
            ],
            [
                'attribute' => 'esito',
                'value' => function($model){
                    return Segnalazioni::getEsito($model->esito);
                }
            ]
        ],
    ]) ?>

    <?php
        if($news != null) {
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
        <?= Html::a('Choose a verdict', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
