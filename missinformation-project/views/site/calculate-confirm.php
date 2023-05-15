<?php
use yii\helpers\Html;

?>



<div class="site-index">

    <h1>Notizie</h1>
    <ul>
    <?php $soggetti; $dataPubblicazione; $dataAccaduto?>
    <?php foreach ($query as $news): ?>
        <li>
            <?php
            $soggetti = $news->coinvolgimento;
            $dataPubblicazione = $news->data_pubblicazione;
            $dataAccaduto = $news->data_accaduto;
            ?>
            <?= $news->link;?>
            <?= $news->descrizione_notizia;?>
        </li>
    <?php endforeach; ?>
    </ul>

    <div class="jumbotron text-center bg-transparent">
        <?php
            if($model->indice_attendibilita  >= 50) {
                echo '<h1 class="display-4">The article is affidable!</h1>';
                echo '<p class="lead">You can trust this article because it has an affidability index of ',$model->indice_attendibilita,'</p>';
            }
            else {
                echo '<h1 class="display-4">The article is NOT affidable!</h1>';
                echo '<p class="lead">This article is not affidable because it has an affidability index of ',$model->indice_attendibilita,'</p>';
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
                    <li><?= $soggetti;?></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h3>Other infos</h3>
                <ul>
                    <li>Publishing date: <?=$dataPubblicazione;?></li>
                    <li>Event date: <?=$dataAccaduto?></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul>
                <?php
                    if($model->indice_attendibilita < 50) {
                        
                        echo '<h2>These articles are more reliable</h2>';
                        foreach ($secondQuery as $news2):
                           echo"<li>";
                           echo $news2->link;
                           echo " ";
                           echo $news2->descrizione_notizia;
                           echo"</li>";
                        endforeach;
                        echo '<p class="lead">You can trust these article because they have an affidability index superior than 50 </p>';
                    }
                ?>
                </ul>
                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Check similar articles</a></p>
            </div>
        </div>

    </div>
</div>