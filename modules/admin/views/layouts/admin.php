<?php

use app\widgets\Alert;
use app\modules\admin\Module;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


\yii2mod\alert\AlertAsset::register($this);

/* @var $this \yii\web\View */
/* @var $content string */

/** @var \yii\web\Controller $context */
$context = $this->context;

if (isset($this->params['breadcrumbs'])) {
    $panelBreadcrumbs = [['label' => Module::t('module', 'ADMIN'), 'url' => ['/admin/default/index']]];
    $breadcrumbs = $this->params['breadcrumbs'];
} else {
    $panelBreadcrumbs = [Module::t('module', 'ADMIN')];
    $breadcrumbs = [];
}
?>
<?php $this->beginContent('@app/modules/admin/views/layouts/layout.php'); ?>

<?= $this->render('_menu') ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => ArrayHelper::merge($panelBreadcrumbs, $breadcrumbs),
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>


<?php $this->endContent(); ?>