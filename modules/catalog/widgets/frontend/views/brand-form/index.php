<?php

use app\modules\main\components\Tr;

echo \app\modules\catalog\widgets\frontend\MenuBlock::widget([
    'title' => Tr::t('main', 'SEARCH_ON_MODEL'),
    'items' => $model
]) ?>