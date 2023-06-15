<?php

use yii\helpers\Html;
use app\models\Fonte;

?>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/panel.js"></script>


<?php if($font == null): ?>

    <div class="jumbotron text-center bg-transparent">
        <?php
            echo '<h1 class="display-4">The source does not exist!</h1>';
            echo '<p class="lead">There is no source to trust if it does not exist </p>';
        ?>
    </div>
<?php else:?> 
<?php $indice_attendibilita = $font->indice_fonte; ?>
<div class="site-index">
    <h1>Infos:</h1>
    <div id="source" class="jumbotron text-center bg-transparent">
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
                <?php if($indice_attendibilita < 50):?>
                    <?php if($font2 != null): ?>
                        <?php 
                            $i = 1;
                            echo '<h2>These sources are more affidable</h2>';
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Source Name</th>
                                    <th scope="col">Reliability Index</th>
                                    <th scope="col">Source Link</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($font2 as $ft2):?>
                                <tr>
                                    <td><?=$ft2->nome_fonte ?></td>
                                    <td><?=$ft2->indice_fonte ?></td>
                                    <td><?= Html::a(Html::encode($ft2->link_fonte), $ft2->link_fonte, ['target'=>'_blank'])?></td>
                                </tr>
                            </tbody>
                            <?php endforeach; ?>
                        </table>
                    <?php else:
                        echo '<h2>We don\'t have more affidable sources for the same argument</h2>';
                        echo '<p class="lead">For this argument, we don\'t have more affidable sourcess</p>';
                        endif;
                    endif;       
                    ?>   
            </div>
        </div>
        <button id="toggleButton" class="btn btn-outline-secondary" type="button" onclick="toggleSource(<?= $font->id_fonte ?>); hideSource(<?= $font->id_fonte ?>)">Block Source</button>
        <script>
            function getCookie(name) {
                let matches = document.cookie.match(new RegExp(
                    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                ));
                return matches ? decodeURIComponent(matches[1]) : undefined;
            }

            let button = document.getElementById('toggleButton');
            if (button) {
                button.textContent = (getCookie(<?= $font->id_fonte ?> + '-source') === "true" ? true : false) ? "Unblock Source" : "Block Source";
            }

        </script>
    </div>
</div>
<?php endif;?>