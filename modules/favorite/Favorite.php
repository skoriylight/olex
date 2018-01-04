<?php

namespace app\modules\favorite;

use app\modules\favorite\models\FavoriteElement;

class Favorite extends \yii\base\Component
{
    private $_elements = null;
    private $_count = null;
    //public $model_class = 'app\modules\catalog\models\Product';


    public function init()
    {
        $this->update();
    }

    public function put($element)
    {
        if(!is_null($model = $this->getElement($element))) {
            return $model;
        }
        $model = new FavoriteElement();
        if(\Yii::$app->user->isGuest) {
            $model->tmp_user_id = FavoriteElement::getUserId();
        } else {
            $model->user_id = FavoriteElement::getUserId();
        }
        $model->model = $element->model;
        $model->item_id = $element->id;
        if($model->save()) {
            $this->update();
            return $model;
        }
        return null;
    }

    public function getElements()
    {
        if (is_null($this->_elements)) {
            $this->update();
        }
        return $this->_elements;
    }

    public function getElement($model){
        $el = FavoriteElement::find()
            ->where([
                'item_id' => $model->id,
                'model' => $model->model
            ]);
        if(\Yii::$app->user->isGuest) {

            $el = $el->andWhere(['tmp_user_id' => FavoriteElement::getUserId()]);
        } else {
            $el = $el->andWhere(['user_id' => FavoriteElement::getUserId()]);
        }
        $el = $el->one();
        if(!is_null($el) ) {
            return $el;
        }
            return null;
    }

    public function getCount()
    {
        if (is_null($this->_count)) {
            $this->update();
        }

        return $this->_count;
    }

    public function deleteElement($element)
    {
        $model = FavoriteElement::find()->where(['item_id' => $element->id, 'model' => $element->model])->limit(1)->one();
        if(!is_null($model)){
            $model->delete();
            $this->update();
            return true;
        }
        return false;
    }

    public function update()
    {
        $this->_elements = FavoriteElement::getElements();

        foreach ($this->_elements as $key=>$one) {
            $this->_count[$key] = count($one);
        }


    }


}