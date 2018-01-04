<?php

use yii\db\Migration;

class m170926_154552_add_price_type_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'price_type', $this->integer(1));

    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'price_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170926_154552_add_price_type_column cannot be reverted.\n";

        return false;
    }
    */
}
