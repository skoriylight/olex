<?php

use yii\db\Migration;

class m171107_221953_create_foregin_key extends Migration
{
    public function safeUp()
    {

        \app\modules\goods\models\Goods::deleteAll(
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



    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171107_221953_create_foregin_key cannot be reverted.\n";

        return false;
    }
    */
}
