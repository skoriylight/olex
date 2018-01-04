<?php

use yii\db\Migration;

class m171123_221218_add_foregin_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_category_id_id', '{{%catalog_category_entity}}', 'category_id', '{{%catalog_category}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->addForeignKey(
            'fk_catalog_category_entity__product_id__id', '{{%catalog_category_entity}}', 'product_id', '{{%catalog_product}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m171123_221218_add_foregin_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171123_221218_add_foregin_keys cannot be reverted.\n";

        return false;
    }
    */
}
