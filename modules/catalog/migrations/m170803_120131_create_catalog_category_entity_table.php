<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog_category_entity`.
 */
class m170803_120131_create_catalog_category_entity_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%catalog_category_entity%}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx_catalog_category_entity_category_id', '{{%catalog_category_entity%}}', 'category_id');
        $this->createIndex('idx_catalog_category_entity_product_id', '{{%catalog_category_entity%}}', 'product_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%catalog_category_entity%}}');
    }
}
