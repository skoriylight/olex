<?php

namespace app\modules\catalog\behaviors;


use app\modules\catalog\models\Category;
use app\modules\catalog\models\Tree;
use app\modules\property\models\Object;
use yii\db\ActiveRecord;
use yii\base\Behavior;

class CategoryTreeBehavior extends Behavior
{

    public $_category = null;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function afterInsert($event)
    {
        $this->getModel();
    }

    public function afterUpdate($event)
    {
        $this->getModel();
    }

    public function afterDelete($event)
    {
        // ...
    }

    public function getCategories()
    {

        return $this->owner->hasMany(Category::className(), ['tree_id' => 'id']);
    }

    public function getCategory()
    {
        unset($this->owner->categories);
        if(!isset($this->owner->categories[0])) {
            return null;
        } else {
            return $this->owner->categories[0];
        }
    }

    public function getParent()
    {
        return $this->owner->hasOne(Tree::className(), ['id' => 'root']);
    }

    public function getParentCategory()
    {
        return $this->owner->parent->category;
    }

    public function getModel()
    {
        $owner = $this->owner;
        if (is_null($owner->category)) {
            $model = new Category();
        } else {
            $model = $owner->category;
        }

        /*if ($owner->lvl > 0) {
            $model->parent_id = $this->owner->parentCategory->id;
        } else {
            $model->parent_id = 0;
        }*/

        $model->name = $owner->name;

        $model->tree_id = $owner->id;
        $model->save();

    }

}