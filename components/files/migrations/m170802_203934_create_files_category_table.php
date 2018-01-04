<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files_catogory`.
 */
class m170802_203934_create_files_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%files_category%}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string(),
            'base_url' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'order' => $this->integer(),
            'foreign_key_id' => $this->integer()->notNull(),

        ]);

        $this->createIndex('idx_files_category_order', '{{%files_category%}}', 'order');
        $this->createIndex('idx_files_category_foreign_key_id', '{{%files_category%}}', 'foreign_key_id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%files_category%}}');
    }
}
