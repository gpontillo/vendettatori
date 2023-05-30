<?php

use yii\helpers\Html;
use app\models\Notizia;

$indice_attendibilita = $news->indice_attendibilita;
$soggetti = empty($news->coinvolgimento) ? [] : explode(Notizia::separatorSoggetti, $news->coinvolgimento);
$dataPubblicazione = $news->data_pubblicazione;
$dataAccaduto = $news->data_accaduto;
$fonte = $news->getFonte0()->one()->link_fonte;
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <?php
        if ($indice_attendibilita >= 50) {
            echo '<h1 class="display-4">The article is affidable!</h1>';
            echo '<p class="lead">You can trust this article because it has an affidability index of ', $indice_attendibilita, '</p>';
        } else if ($indice_attendibilita === -1) {
            echo '<h1 class="display-4">The article is not yet calculated!</h1>';
            echo '<p class="lead">We are sorry for the inconvinience but one of our moderator is still reviewing this article</p>';
        } else {
            echo '<h1 class="display-4">The article is NOT affidable!</h1>';
            echo '<p class="lead">This article is not affidable because it has an affidability index of ', $indice_attendibilita, '</p>';
        }
        ?>
    </div>

    <?php if ($indice_attendibilita != -1) : ?>
        <div class="body-content">
            <div class="row">
                <div class="col-lg-12">
                    <h2>News data</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Subjects involved</h3>
                    <?php if (empty($soggetti)) : ?>
                    <?= '<p>None</p>' ?>
                    <?php else : ?>
                        <ul>
                            <?php
                            foreach ($soggetti as $soggetto) {
                                echo '<li>' . $soggetto . '</li>';
                            }
                            ?>
                        </ul>
                    <?php endif; ?>
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
                        <li>Event place(s):
                            <?= $news->luogo ?>
                        </li>
                        <li>Link:
                            <?= Html::a($news->link, $news->link, ['target'=>'_blank']) ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php
                    if ($indice_attendibilita < 50) {
                        if ($news2 != null) {
                            echo '<h2>This article is more affidable</h2>';
                            echo '<p class="lead">';
                            echo $news2->descrizione_notizia;
                            echo "</p>";
                            echo Html::a('Clicca qui per vedere questa notizia', $news2->link, ["target" => "_blank"]);
                            echo '<p class="mt-2">You can trust this article because it has an affidability index of ', $news2->indice_attendibilita, ' </p>';
                        } else {
                            echo '<h2>We don\'t have more affidable articles for the same argument</h2>';
                            echo '<p class="lead">For this argument, we don\'t have more affidable news</p>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= Html::a('Check similar articles', ['/site/similar-articles', 'id' => $news->id, 'argument' => str_replace(Notizia::separatorSoggetti, '_', $news->argomento)], ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::button('Block source', ['class' => 'btn btn-outline-secondary', 'name' => 'Block']) ?>
                    <?= Html::a('Report article', ['/site/report-article', 'url' => $news->link, 'id' => $news->id], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>