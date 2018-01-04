<?php

use yii\helpers\Html;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
\kuakling\lobibox\LobiboxAsset::register($this);
\app\modules\catalog\widgets\cart\UpdateElements::widget();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <header>
            <?=$this->render('parts/_header-top'); ?>
            <?=$this->render('parts/_header-main'); ?>
        </header>
        <?= $content ?>
    <div class="footer-wrap"></div>
    </div>
        <footer class="footer">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6"><span class="footer-logo  copyright">2011 - 2016 © MobiMag.com.ua</span></div>
                            <div class="col-md-6">Скачивайте
                                <div>

                                    <a href="#" class="mobile-store-btn">
                                        <span class="mobile-store-icon android icon-wrap"></span>
                                        <span class="mobile-store-text">приложение для Android</span>
                                    </a>
                                    <a href="#" class="mobile-store-btn">
                                        <span class="mobile-store-icon apple icon-wrap"></span>
                                        <span class="mobile-store-text">приложение для IOS</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6">Принимаем
                                <div>
                                    <div class="icon-wrap icon-footer pb24"></div>
                                    <div class="icon-wrap icon-footer visa"></div>
                                    <div class="icon-wrap icon-footer master-card"></div>
                                </div>

                            </div>
                            <div class="col-md-6">Следите за нами

                                <div>

                                    <a href="#"><div class="icon-wrap icon-footer vk"></div></a>
                                    <a href="#"><div class="icon-wrap icon-footer fb"></div></a>
                                    <a href="#"><div class="icon-wrap icon-footer in"></div></a>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </footer>


<?php

$js = <<<JS
$('[data-img-id]').hover(function(){
    var id = $(this).attr('data-img-id');
    img = $(this).attr('data-img');
    $('#'+id).css('background-image' , 'url('+img+')');
    $('#'+id).css('display', 'block');
},
function(){
    var id = $(this).attr('data-img-id');
    $('#'+id).css('display', 'none');
}
);


JS;


$this->registerJs($js);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
