<?php

use yii\db\Migration;

class m171116_013302_add_foregin_key extends Migration
{
    public function safeUp()
    {

        \app\modules\property\models\HandlerValue::deleteAll(
            "NOT EXISTS(SELECT 1 FROM {{%catalog_product%}} WHERE {{%catalog_product%}}.id = {{%goods%}}.product_id)
            ");

        $this->addForeignKey(
            'fk_goods', '{{%goods}}', 'product_id', '{{%catalog_product}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_goods', '{{%goods}}');

        return false;
    }

}
