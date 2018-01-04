<?php

use yii\db\Migration;

class m171019_185929_add_other_field_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%order_shipping_type%}}', 'extra_fields', $this->boolean()->defaultValue(false));

    }


    public function safeDown()
    {
        $this->dropColumn('{{%order_shipping_type%}}', 'extra_fields');

        return false;
    }
}
