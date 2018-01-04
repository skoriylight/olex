<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog_price`.
 */
class m170925_071745_create_catalog_price_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%catalog_price%}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(),
            'old_value' => $this->float(),
            'value' => $this->float(),
            'object_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('idx_catalog_price_type', '{{%catalog_price%}}', 'type');
        $this->createIndex('idx_catalog_price_old_value', '{{%catalog_price%}}', 'old_value');
        $this->createIndex('idx_catalog_price_value', '{{%catalog_price%}}', 'value');
        $this->createIndex('idx_catalog_price_object_id', '{{%catalog_price%}}', 'object_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%catalog_price%}}');
    }
}
