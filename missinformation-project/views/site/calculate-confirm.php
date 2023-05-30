<?php

use yii\helpers\Html;
use app\models\Notizia;

$indice_attendibilita = $news->indice_attendibilita;
$soggetti = explode(Notizia::separatorSoggetti,$news->coinvolgimento);
$dataPubblicazione = $news->data_pubblicazione;
$dataAccaduto = $news->data_accaduto;
$fonte = $news->getFonte0()->one()->link_fonte;
?>
<div class="site-index">
    <?php
    //da controllare il cockie
    if (true)
        echo '
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        La fonte di questa notizia è stata bloccata. <a href="https://www.w3schools.com">Clicca qui per sbloccarla</a>
                    </div>
                </div>
            ';
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
                <h3>Subjects involved</h3>
                <ul>
                    <?php 
                        foreach($soggetti as $soggetto) {
                            echo '<li>'.$soggetto.'</li>';
                        } 
                    ?>
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
                    <li>Source:
                        <?= $fonte ?>
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
                <?= Html::a('Check similar articles', ['/site/similar-articles', 'argument' => 0], ['class' => 'btn btn-outline-secondary']) ?>
                <?= Html::button('Block source', ['class' => 'btn btn-outline-secondary']) ?>
                <?= Html::a('Report article', ['/site/report-article', 'url' => $news->link, 'id' => $news->id], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>
</div>