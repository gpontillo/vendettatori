<?php

use yii\helpers\Html;

?>
<div class="site-about">
    <h2>Similar articles</h2>
    <div class="body-content">
        <div class="accordion" id="accordionExample">
            <?php
                $i = 1;
                foreach($list_news as $news) {
                    echo '
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse',$i,'" aria-expanded="true" aria-controls="collapse',$i,'">
                                ',$news->descrizione_notizia," - Attendibility: ",$news->indice_attendibilita,'
                            </button>
                        </h2>
                        <div id="collapse',$i,'" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                ',Html::a("Link notizia", $news->link, ['target'=>'_blank']),'
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