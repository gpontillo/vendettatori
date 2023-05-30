<?php

use app\models\Segnalazioni;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Breadcrumbs;

/** @var yii\web\View $this */
/** @var app\models\SegnalazioniSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users\' reports';

?>

<div class="segnalazioni-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?php // Html::a('Create Segnalazioni', ['create'], ['class' => 'btn btn-success']) 
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'url:url',
            'motivo',
            [
                'attribute' => 'valutazione',
                'value' => function($model){
                    return Segnalazioni::getValutazione($model->valutazione);
                },
                'filter'=>Segnalazioni::VALUTAZIONI_ARRAY,
            ],
            [
                'attribute' => 'esito',
                'value' => function($model){
                    return Segnalazioni::getEsito($model->esito);
                },
                'filter'=>Segnalazioni::ESITO_ARRAY,
            ],
            'id_notizia',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Segnalazioni $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>