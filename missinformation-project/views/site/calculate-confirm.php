<?php

use yii\helpers\Html;
use app\models\Notizia;
use app\models\Media;

$indice_attendibilita = $news->indice_attendibilita;
$soggetti = empty($news->coinvolgimento) ? [] : explode(Notizia::separatorSoggetti, $news->coinvolgimento);
$dataPubblicazione = $news->data_pubblicazione;
$dataAccaduto = $news->data_accaduto;
$fonte = $news->getFonte0()->one()->nome_fonte;
?>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/panel.js"></script>
<div id="alertblock" class="alert alert-warning d-flex align-items-center" role="alert" style="display: none !important;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle mr-5" viewBox="0 0 16 16" style="margin-left: 12px; margin-right: 12px;">
        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
    </svg>
    This news is from a blocked source. If you want to unblock it and see the news from this source <button type="button" class="btn btn-link" onclick="unblockForNews(<?= $news->fonte ?>)">Click here</button>
</div>
<div id="newsdiv" class="site-index">
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
                            <?= Html::a($news->link, $news->link, ['target' => '_blank']) ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col">
                <div id="carouselExample" class="carousel slide carousel-img-news" style="margin-bottom: 1rem !important; margin-top: 2rem !important;">
                    <div class="carousel-inner">
                        <?php
                        $medias = new Media();
                        $query = $medias->retriveMedia($news->id);
                        foreach ($query as $q):
                            echo "<div class='carousel-item active container-img'>";
                            if ($medias->isImage($q->estensione)):
                                echo "<img src='" . $q->percorso . "' class='d-block w-100' width='100'>";
                            elseif ($medias->isAudio($q->estensione)):
                                echo "<img src='" . "data:image/png;base64,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" . "' class='d-block w-100' width='100'>";
                            elseif ($medias->isVideo($q->estensione)):
                                echo " <video width='300' controls>
                                    <source src='" . $q->percorso . "' type='video/" . $q->estensione . "'>
                                    </video> ";
                            endif;
                            echo "</div>";
                        endforeach;
                        ?>
                        <!-- <div class="carousel-item active">
                            <img src="https://www.zend.com/sites/default/files/image/2019-09/logo-yii-framework.jpg"
                                class="d-block w-100" alt="...">
                        </div> -->


                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" style="color: black;" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
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
                            echo Html::a('Click here to see the news', $news2->link, ["target" => "_blank"]);
                            echo '<p class="mt-2">You can trust this article because it has an affidability index of ', $news2->indice_attendibilita, ' </p>';
                        } else {
                            echo '<h2>We don\'t have more affidable articles for the same argument</h2>';
                            echo '<p class="lead">For this argument, we don\'t have more affidable news</p>';
                        }
                    }
                    ?>

                    </ul>
                    <h3>About Article</h3>
                    <?= Html::a('Check similar articles', ['/site/similar-articles', 'id' => $news->id, 'argument' => str_replace(Notizia::separatorSoggetti, '_', $news->argomento)], ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::a('Report article', ['/site/report-article', 'url' => $news->link, 'id' => $news->id], ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::a('Report media for this article', ['/site/report-media', 'url' => $news->link, 'id' => $news->id], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>


<script>
    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    let newsPage = document.getElementById('newsdiv');
    let alertBlock = document.getElementById('alertblock');
    if (newsPage != null && alertBlock != null) {
        if (getCookie(<?= $news->fonte ?> + '-source') === "true") {
            alertBlock.style = "display: block !important;";
            newsPage.style = "display: none !important;";
        } else {
            alertBlock.style = "display: none !important;";
            newsPage.style = "display: block !important;";
        }
    }
</script>