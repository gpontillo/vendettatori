<?php

use yii\helpers\Html;

$indice_attendibilita = $font->indice_fonte;
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
                <?php if($indice_attendibilita < 50):?>
                    <?php if($font2 != null): ?>
                        <?php 
                            $i = 1;
                            echo '<h2>These sources are more affidable</h2>';
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome Fonte</th>
                                    <th scope="col">Indice attendiblità Fonte</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($font2 as $ft2):?>
                                <tr>
                                    <th scope="row"><?= $i++;?></th>
                                    <td><?=$ft2->descrizione_fonte ?></td>
                                    <td><?=$ft2->indice_fonte ?></td>
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

    </div>
</div>