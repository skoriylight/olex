<?php

use yii\helpers\Html;
use app\modules\admin\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
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
        <?= $content ?>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::$app->name ?></p>
            <p class="pull-right"><?= date('Y') ?></p>
        </div>
    </footer>

<?php

$js = <<<JS

    yii.confirm = function (message, okCallback, cancelCallback) {
        swal({
            title: message,
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: true,
            allowOutsideClick: true
        }, okCallback);
    };

JS;


$this->registerJs($js);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
