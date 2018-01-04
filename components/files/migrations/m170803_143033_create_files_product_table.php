<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files_product`.
 */
class m170803_143033_create_files_product_table extends Migration
{
    /**
     * @inheritdoc
     */

        public function up()
    {
        $this->createTable('{{%files_product%}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string(),
            'base_url' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'order' => $this->integer(),
            'foreign_key_id' => $this->integer()->notNull(),

        ]);

        $this->createIndex('idx_files_product_order', '{{%files_product%}}', 'order');
        $this->createIndex('idx_files_product_foreign_key_id', '{{%files_product%}}', 'foreign_key_id');

    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%files_product%}}');
    }
}
