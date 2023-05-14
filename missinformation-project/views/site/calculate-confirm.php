<?php
use yii\helpers\Html;

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <?php
            if($model->indiceAttendibilita >= 50) {
                echo '<h1 class="display-4">The article is affidable!</h1>';
                echo '<p class="lead">You can trust this article because it has an affidability index of ',$model->indiceAttendibilita,'</p>';
            }
            else {
                echo '<h1 class="display-4">The article is NOT affidable!</h1>';
                echo '<p class="lead">This article is not affidable because it has an affidability index of ',$model->indiceAttendibilita,'</p>';
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
                    <li>Rob</li>
                    <li>George</li>
                    <li>Kyle</li>
                    <li>Hannah</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h3>Other infos</h3>
                <ul>
                    <li>Publishing date: 01/01/1997</li>
                    <li>Event date: 01/01/1997</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if($model->indiceAttendibilita < 50) {
                        echo '<h2>This article is more affidable</h2>';
                        echo '<p class="lead">You can trust this article because it has an affidability index of 80 </p>';
                        echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>';
                    }
                ?>
                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Check similar articles</a></p>
            </div>
        </div>

    </div>
</div>