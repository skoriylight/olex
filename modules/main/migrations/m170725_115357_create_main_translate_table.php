<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `main_translate`.
 */
class m170725_115357_create_main_translate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%main_translate}}', [
            'id' => $this->primaryKey(),
            'language_id' => Schema::TYPE_STRING,
            'class_name' => Schema::TYPE_STRING,
            'attribute' => Schema::TYPE_STRING,
            'message' => Schema::TYPE_TEXT,
            'model_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->createIndex('main_translate_idx_language_id', '{{%main_translate}}', 'language_id');
        $this->createIndex('main_translate_idx_class_name', '{{%main_translate}}', 'class_name');
        $this->createIndex('main_translate_idx_attribute', '{{%main_translate}}', 'attribute');
        $this->createIndex('main_translate_idx_model_id', '{{%main_translate}}', 'model_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%main_translate}}');
    }
}
