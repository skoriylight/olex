<?php

use yii\db\Migration;

class m171106_010335_add_img_columns extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%catalog_category}}', 'img_folder', $this->string());
        $this->addColumn('{{%catalog_category}}', 'icon_folder', $this->string());
        $this->addColumn('{{%catalog_category}}', 'img_path', $this->string());
        $this->addColumn('{{%catalog_category}}', 'icon_path', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%catalog_category}}', 'img_folder');
        $this->dropColumn('{{%catalog_category}}', 'icon_folder');
        $this->dropColumn('{{%catalog_category}}', 'img_path');
        $this->dropColumn('{{%catalog_category}}', 'icon_path');
        return false;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171106_010335_add_img_columns cannot be reverted.\n";

        return false;
    }
    */
}
