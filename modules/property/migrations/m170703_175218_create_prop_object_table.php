<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prop_pbject`.
 */
class m170703_175218_create_prop_object_table extends Migration
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

        $this->createTable('prop_object', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->integer(),
            'alias' => $this->string(),
            'class' => $this->string(),
            'order' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx_property_name', 'prop_object', 'name');
        $this->createIndex('idx_property_alias', 'prop_object', 'alias');
        $this->createIndex('idx_property_class', 'prop_object', 'class');
        $this->createIndex('idx_property_order', 'prop_object', 'order');

        $this->createTable('prop_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'alias' => $this->string(),
            'class' => $this->string(),
        ]);

        $this->createIndex('idx_property_group_alias', 'prop_group', 'alias');
        $this->createIndex('idx_property_group_class', 'prop_group', 'class');
        $this->createIndex('idx_property_group_name', 'prop_group', 'name');

        $this->createTable('prop_object_group', [
            'id' => $this->primaryKey(),
            'object_id' => $this->integer(),
            'group_id' => $this->integer(),
        ]);

        $this->createIndex('idx_property_object_group_object_id', 'prop_object_group', 'object_id');
        $this->createIndex('idx_property_object_group_group_id', 'prop_object_group', 'group_id');

        $this->createTable('prop_value', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'alias' => $this->string(),
            'object_id' => $this->string(),
            'order' => $this->integer(),
        ]);

        $this->createIndex('idx_property_value_name', 'prop_value', 'name');
        $this->createIndex('idx_property_value_alias', 'prop_value', 'alias');
        $this->createIndex('idx_property_value_object_id', 'prop_value', 'object_id');
        $this->createIndex('idx_property_value_order', 'prop_value', 'order');

        $this->createTable('prop_handler_value', [
            'id' => $this->primaryKey(),
            'object_id' => $this->integer(),
            'handler_id' => $this->integer(),
            'value_id' => $this->integer(),
        ]);

        $this->createIndex('idx_property_handler_value_object_id', 'prop_handler_value', 'object_id');
        $this->createIndex('idx_property_handler_value_handler_id', 'prop_handler_value', 'handler_id');
        $this->createIndex('idx_property_handler_value_value_id', 'prop_handler_value', 'value_id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('prop_object');
        $this->dropTable('prop_group');
        $this->dropTable('prop_object_group');
        $this->dropTable('prop_value');
        $this->dropTable('prop_handler_value');
    }
}
