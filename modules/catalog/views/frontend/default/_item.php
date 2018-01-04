<?php

use app\modules\catalog\widgets\frontend\ProductView;

echo ProductView::widget([
    'model' => $model
]);