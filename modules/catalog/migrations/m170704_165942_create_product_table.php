<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170704_165942_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('catalog_product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'title' => $this->string(),
            'price' => $this->float(),
            'slug' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'position' => $this->integer(),
            'parent_id' => $this->integer(),
            'article' => $this->string(),
            'create_at' => $this->integer(),
            'update_at' => $this->integer(),
            'category_id' => $this->integer(),
            'color' => $this->string(),
        ]);

        $this->createIndex('idx_catalog_product_name', 'catalog_product', 'name');
        $this->createIndex('idx_catalog_product_price', 'catalog_product', 'price');
        $this->createIndex('idx_catalog_product_slug', 'catalog_product', 'slug');
        $this->createIndex('idx_catalog_product_position', 'catalog_product', 'position');
        $this->createIndex('idx_catalog_product_article', 'catalog_product', 'article');
        $this->createIndex('idx_catalog_product_update_at', 'catalog_product', 'update_at');
        $this->createIndex('idx_catalog_product_create_at', 'catalog_product', 'create_at');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalog_product');
    }
}
