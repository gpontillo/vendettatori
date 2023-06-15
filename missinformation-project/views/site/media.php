<?php

use yii\helpers\Html;
use yii\imagine\Image;
use app\models\Notizia;
use app\models\Media;


//$model è il media
//$news è la lista delle notizie
$model->calculateIndice();
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
                <h2>Media data</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3>Metadata</h3>
                <ul>
                    <?php
                    echo "<li>Creation " . date('Y-m-d H:i:s', filectime(Yii::getAlias('@webroot') . $model->percorso)) . "</li>";
                    echo "<li>File size: " . filesize(Yii::getAlias('@webroot') . $model->percorso) . " bytes" . "</li>";
                    echo "<li>Last modify: " . date('Y-m-d H:i:s', filectime(Yii::getAlias('@webroot') . $model->percorso)) . "</li>";
                    switch ($tipo):
                        case 1:
                            echo "<li>Type of media: Image</li>";
                            break;
                        case 2:
                            echo "<li>Type of media: Audio</li>";
                            break;
                        case 3:
                            echo "<li>Type of media: Video</li>";
                            break;
                        default:
                            echo "<li>Type of media: Unsupported</li>";
                            break;
                    endswitch;
                    ?>
                </ul>
            </div>
            <div class="col-lg-6 media-show">
                <h3>See media</h3>
                <div class="d-flex justify-content-center">
                    <?php
                    switch ($tipo):
                        case 1:
                            echo "<img src='" . $model->percorso . "' >";
                            break;
                        case 2:
                            echo " <audio controls>
                                <source src='" . $model->percorso . "' type='audio/" . $model->estensione . "'>
                              Your browser does not support the audio element.
                              </audio> ";
                            break;
                        case 3:
                            echo " <video controls>
                                    <source src='" . $model->percorso . "' type='video/" . $model->estensione . "'>
                                    </video> ";
                            break;
                        default:
                            echo "<p>Unsupported media</p>";
                            break;
                    endswitch;
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Media's news</h3>
                <div class="accordion" id="accordionExample">
                    <?php
                    $i = 1;
                    foreach ($news as $articolo) {
                        $fonte = $articolo->getFonte0()->one()->link_fonte;
                        echo '
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse', $i, '" aria-expanded="true" aria-controls="collapse', $i, '">
                                ', $articolo->descrizione_notizia, " - Attendibility: ", $articolo->indice_attendibilita, '
                            </button>
                        </h2>
                        <div id="collapse', $i, '" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <ul>
                                    <li>Subjects involved: ' . (empty($articolo->coinvolgimento) ? 'None' : $articolo->coinvolgimento) . '</li>
                                    <li>Arguments: ' . $articolo->argomento . '</li>
                                    <li>Publishing date: ' . $articolo->data_pubblicazione . '</li>
                                    <li>Event date: ' . $articolo->data_accaduto . '</li>
                                    <li>Event place(s): ' . $articolo->luogo . '</li>
                                    <li>Source: ' . $fonte . '</li>
                                    <li>Link: ', Html::a($articolo->link, $articolo->link, ['target' => '_blank']), '</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    ';
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>