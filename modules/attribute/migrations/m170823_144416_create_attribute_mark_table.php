<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attribute_value`.
 */
class m170823_144416_create_attribute_mark_table extends Migration
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

        $this->createTable('{{%attribute_mark%}}', [
            'id' => $this->primaryKey(),
            'is_sale' => $this->integer(1),
            'is_new' => $this->integer(1),
            'is_hit' => $this->integer(1),
            'is_coming' => $this->integer(1),
            'is_stock' => $this->integer(1),
            'product_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_attribute_mark_is_sale', '{{%attribute_mark%}}', 'is_sale');
        $this->createIndex('idx_attribute_mark_is_new', '{{%attribute_mark%}}', 'is_new');
        $this->createIndex('idx_attribute_mark_is_hit', '{{%attribute_mark%}}', 'is_hit');
        $this->createIndex('idx_attribute_mark_is_coming', '{{%attribute_mark%}}', 'is_coming');
        $this->createIndex('idx_attribute_mark_is_stock', '{{%attribute_mark%}}', 'is_stock');
        $this->createIndex('idx_attribute_mark_product_id', '{{%attribute_mark%}}', 'product_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%attribute_mark%}');
    }
}
