<?php

namespace app\modules\catalog\models\frontend;

use app\modules\catalog\models\Product;

Class CartElement extends \dvizh\cart\models\CartElement{

    public function getProducts(){
        return $this->hasOne(Product::className(), ['id' => 'product_id'])
            ->viaTable('{{%goods%}}', ['id' => 'item_id']);
    }
}