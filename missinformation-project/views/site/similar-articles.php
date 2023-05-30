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
                    $fonte = $news->getFonte0()->one()->link_fonte;
                    echo '
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse',$i,'" aria-expanded="true" aria-controls="collapse',$i,'">
                                ',$news->descrizione_notizia," - Attendibility: ",$news->indice_attendibilita,'
                            </button>
                        </h2>
                        <div id="collapse',$i,'" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <ul>
                                    <li>Subjects involved: '.(empty($news->coinvolgimento)? 'None' : $news->coinvolgimento).'</li>
                                    <li>Arguments: '.$news->argomento.'</li>
                                    <li>Publishing date: '.$news->data_pubblicazione.'</li>
                                    <li>Event date: '.$news->data_accaduto.'</li>
                                    <li>Event place(s): '.$news->luogo.'</li>
                                    <li>Source: '.$fonte.'</li>
                                    <li>Link: ',Html::a($news->link, $news->link, ['target'=>'_blank']),'</li>
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