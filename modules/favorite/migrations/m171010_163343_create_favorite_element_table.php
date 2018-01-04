<?php

use yii\db\Migration;

/**
 * Handles the creation of table `favorite_element`.
 */
class m171010_163343_create_favorite_element_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%favorite_element%}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'model' => $this->string()->notNull(),
            'user_id' => $this->integer(),
            'tmp_user_id' => $this->integer(),


        ], $tableOptions);

        $this->createIndex('idx_favorite_element_item_id', '{{%favorite_element%}}', 'item_id');
        $this->createIndex('idx_favorite_element_model', '{{%favorite_element%}}', 'model');
        $this->createIndex('idx_favorite_element_tmp_user_id', '{{%favorite_element%}}', 'tmp_user_id');
        $this->createIndex('idx_favorite_element_user_id', '{{%favorite_element%}}', 'user_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('favorite_element');
    }
}
