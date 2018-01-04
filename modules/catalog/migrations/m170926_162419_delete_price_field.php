<?php

use yii\db\Migration;

class m170926_162419_delete_price_field extends Migration
{
    public function safeUp()
    {

    }



    public function up()
    {
        $this->dropColumn('{{%catalog_product}}', 'price');
    }

    public function down()
    {
        $this->addColumn('{{%catalog_product}}', 'price', $this->float());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170926_162419_delete_price_field cannot be reverted.\n";

        return false;
    }
    */
}
