<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m170816_134721_create_goods_table extends Migration
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

        $this->createTable('{{%goods%}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'full_name' => $this->string(),
            'is_color' => $this->integer(),
            'product_id' => $this->integer(),
            'sort' => $this->integer(),
            'color' => $this->string(),
            'path' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'file_name' => $this->string(),

        ], $tableOptions);


        $this->createIndex('idx_goods_product_id', '{{%goods%}}', 'product_id');
        $this->createIndex('idx_goods_sort', '{{%goods%}}', 'sort');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%goods%}}');
    }
}
