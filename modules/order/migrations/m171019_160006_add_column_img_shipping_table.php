<?php

use yii\db\Migration;

class m171019_160006_add_column_img_shipping_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%order_shipping_type%}}', 'image_path', $this->string());
        $this->addColumn('{{%order_shipping_type%}}', 'image_name', $this->string());
        $this->addColumn('{{%order_shipping_type%}}', 'image_url', $this->string());
    }


    public function safeDown()
    {
        $this->dropColumn('{{%order_shipping_type%}}', 'image_path');
        $this->dropColumn('{{%order_shipping_type%}}', 'image_name');
        $this->dropColumn('{{%order_shipping_type%}}', 'image_url');
        return false;
    }


}
