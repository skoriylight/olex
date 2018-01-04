<?php

use yii\db\Migration;

class m171020_095049_add_column_profile extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'full_name', $this->string());
        $this->addColumn('{{%user}}', 'phone', $this->string(64));
        $this->addColumn('{{%user}}', 'city', $this->string(64));

        $this->addColumn('{{%user}}', 'shipping_city', $this->string(64));
        $this->addColumn('{{%user}}', 'shipping_type_id', $this->integer());
        $this->addColumn('{{%user}}', 'shipping_dep', $this->integer(64));

        $this->addColumn('{{%user}}', 'recipient_full_name', $this->string());
        $this->addColumn('{{%user}}', 'recipient_phone', $this->string(64));
        $this->addColumn('{{%user}}', 'recipient_city', $this->string(64));




    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'full_name');
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'city');

        $this->dropColumn('{{%user}}', 'shipping_city');
        $this->dropColumn('{{%user}}', 'shipping_type_id');
        $this->dropColumn('{{%user}}', 'shipping_dep');

        $this->dropColumn('{{%user}}', 'recipient_full_name');
        $this->dropColumn('{{%user}}', 'recipient_phone');
        $this->dropColumn('{{%user}}', 'recipient_city');
    }
}
