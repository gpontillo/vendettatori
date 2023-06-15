<?php

use yii\helpers\Html;
use app\models\Notizia;
use app\models\Media;

//$model è il media
//$news è la lista delle notizie
$indice_attendibilita = $model->indice_attendibilita;
?>
<div id="newsdiv" class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <?php
        if ($indice_attendibilita >= 50) {
            echo '<h1 class="display-4">The media is affidable!</h1>';
            echo '<p class="lead">You can trust this media because it has an affidability index of ', $indice_attendibilita, '</p>';
        } else if ($indice_attendibilita === -1) {
            echo '<h1 class="display-4">The media is not yet calculated!</h1>';
            echo '<p class="lead">We are sorry for the inconvinience but one of our moderator is still reviewing this media</p>';
        } else {
            echo '<h1 class="display-4">The media is NOT affidable!</h1>';
            echo '<p class="lead">This media is not affidable because it has an affidability index of ', $indice_attendibilita, '</p>';
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
                <h3>Metadata</h3>
                <ul>
                    <li>test</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h3>See media</h3>
                <p>to do</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Media's news</h3>
                
            </div>
        </div>
    </div>
</div>