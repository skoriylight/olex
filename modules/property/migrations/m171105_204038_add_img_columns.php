<?php

use yii\db\Migration;

class m171105_204038_add_img_columns extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%prop_object}}', 'file_folder', $this->string());
        $this->addColumn('{{%prop_value}}', 'file_folder', $this->string());
        $this->addColumn('{{%prop_object}}', 'file_path', $this->string());
        $this->addColumn('{{%prop_value}}', 'file_path', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%prop_object}}', 'file_folder');
        $this->dropColumn('{{%prop_value}}', 'file_folder');
        $this->dropColumn('{{%prop_object}}', 'file_path');
        $this->dropColumn('{{%prop_value}}', 'file_path');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171105_204038_add_img_columns cannot be reverted.\n";

        return false;
    }
    */
}
