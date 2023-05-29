<?php

use yii\helpers\Html;

$indice_attendibilita = $news->indice_attendibilita;
$soggetti = $news->coinvolgimento;
$dataPubblicazione = $news->data_pubblicazione;
$dataAccaduto = $news->data_accaduto;
?>
<div class="site-index">
    <?php
    //da controllare il cockie
    
    
    ?>
    <div class="jumbotron text-center bg-transparent">
        <?php
        if ($indice_attendibilita >= 50) {
            echo '<h1 class="display-4">The article is affidable!</h1>';
            echo '<p class="lead">You can trust this article because it has an affidability index of ', $indice_attendibilita, '</p>';
        } else {
            echo '<h1 class="display-4">The article is NOT affidable!</h1>';
            echo '<p class="lead">This article is not affidable because it has an affidability index of ', $indice_attendibilita, '</p>';
        }
        ?>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>News data</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3>Subjects of the article</h3>
                <ul>
                    <li>
                        <?= $soggetti ?>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h3>Other infos</h3>
                <ul>
                    <li>Publishing date:
                        <?= $dataPubblicazione ?>
                    </li>
                    <li>Event date:
                        <?= $dataAccaduto ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul>
                    <?php
                    if ($indice_attendibilita < 50) {
                        if ($news2 != null) {
                            echo '<h2>This article is more affidable</h2>';
                            echo $news2->link;
                            echo " ";
                            echo $news2->descrizione_notizia;
                            echo '<p class="lead">You can trust this article because it has an affidability index of ', $news2->indice_attendibilita, ' </p>';
                        } else {
                            echo '<h2>We don\'t have more affidable articles for the same argument</h2>';
                            echo '<p class="lead">For this argument, we don\'t have more affidable news</p>';
                        }
                    }
                    ?>
                </ul>
                <?= Html::a('Check similar articles', ['/site/similar-articles', 'argument' => $news->tipo_categoria], ['class' => 'btn btn-outline-secondary']) ?>
                <?= Html::button('Block source', ['class' => 'btn btn-outline-secondary', 'name' => 'Block']) ?>
                
                <?= Html::a('Report article', ['/site/report-article', 'url' => $news->link, 'id' => $news->id], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>
</div>