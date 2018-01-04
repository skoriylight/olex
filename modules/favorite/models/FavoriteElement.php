<?php

namespace app\modules\favorite\models;

use Yii;

/**
 * This is the model class for table "favorite_element".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $model
 */
class FavoriteElement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorite_element';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'model'], 'required'],
            [['item_id', 'user_id'], 'integer'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'item_id' => Yii::t('catalog', 'Item ID'),
            'model' => Yii::t('catalog', 'Model'),
        ];
    }

    public static function getElements()
    {
        $userId = static::getUserId();
        if (yii::$app->user->isGuest) {
            $model = self::find()->where(['tmp_user_id' => $userId])->with('item')->all();
        } else {
            $model = self::find()->where(['user_id' => $userId])->with('item')->all();
        }
        if(is_null($ret = self::reset($model))) {
            $ret = self::getElements();
        }
        return $ret;
    }

    protected static function reset($model){
        $is_null = 0;
        $ret = [];
        foreach ($model as $el) {
            $ret[$el->model][] = $el;
            if(is_null($el->item)) {
                $el->delete();
                $is_null++;
            }
        }
        return $is_null>0?null:$ret;
    }

    public function getItem()
    {
        return $this->hasOne($this->model, ['id' => 'item_id']);
    }

    public function getItemModel()
    {
        return $this->getItem()->one();
    }

    public static function getUserId()
    {
        $session = yii::$app->session;
        if (!$userId = yii::$app->user->id) {
            if (!$userId = $session->get('favorite_tmp_user_id')) {
                $userId = md5(time() . '-' . yii::$app->request->userIP . Yii::$app->request->absoluteUrl);
                $session->set('favorite_tmp_user_id', $userId);
            }
        }
        return $userId;
    }

    public function getFavorite()
    {
        return $this->hasOne(FavoriteElement::className(), ['item_id' => 'id'])->where([ 'model' => $this->model]);
    }

    public function getModel()
    {
        return self::className();
    }
}
