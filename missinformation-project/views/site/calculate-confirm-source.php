<?php

use yii\helpers\Html;

$indice_attendibilita = $font->indice_fonte;
$descrizione_notizia = $font->descrizione_fonte;
?>
<div class="site-index">
    <h1>Infos:</h1>
    <div class="jumbotron text-center bg-transparent">
        <?php
        if ($indice_attendibilita  >= 50) {
            echo '<h1 class="display-4">The source is affidable!</h1>';
            echo '<p class="lead">You can trust this source because it has an affidability index of ', $indice_attendibilita, '</p>';
        } else {
            echo '<h1 class="display-4">The source is NOT affidable!</h1>';
            echo '<p class="lead">This source is not affidable because it has an affidability index of ', $indice_attendibilita, '</p>';
        }
        ?>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <ul>
                    <?php
                    if ($indice_attendibilita < 50) {
                        if ($font2 != null) {
                            echo '<h2>This source is more affidable</h2>';
                            echo " ";
                            echo $font2->descrizione_fonte;
                            echo '<p class="lead">You can trust this source because it has an affidability index of ', $font2->indice_fonte, ' </p>';
                        } else {
                            echo '<h2>We don\'t have more affidable sources for the same argument</h2>';
                            echo '<p class="lead">For this argument, we don\'t have more affidable sourcess</p>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>