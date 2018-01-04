<?php

use app\modules\admin\Module;
use app\modules\user\Module as UserModule;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\backend\User */

$this->title = Module::t('module', 'ADMIN');
?>
<div class="admin-default-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(UserModule::t('module', 'ADMIN_USERS'), ['user/default/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="btn-group">
        <button type="button" class="btn btn-default">Кнопка</button>
        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="#">Пункт 1</a></li>
            <li><a href="#">Пункт 2</a></li>
            <li class="divider"></li>
            <li><a href="#">Пункт 3</a></li>
        </ul>
    </div>
</div>
