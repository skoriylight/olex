<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog_category`.
 */
class m170705_103933_create_catalog_category_table extends Migration
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
        $this->createTable('{{%catalog_category%}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
            'parent_id' => $this->integer(),
            'content' => $this->text(),
            'slug' => $this->string(),
            'position' => $this->integer(),
            'depth' => $this->integer(),
            'image_url' => $this->string(),
        ], $tableOptions);

        $this->createIndex('idx_catalog_category_name', '{{%catalog_category%}}', 'name');
        $this->createIndex('idx_catalog_category_position', '{{%catalog_category%}}', 'position');
        $this->createIndex('idx_catalog_category_slug', '{{%catalog_category%}}', 'slug');
        $this->createIndex('idx_catalog_category_parent_id', '{{%catalog_category%}}', 'parent_id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%catalog_category%}}');
    }
}
