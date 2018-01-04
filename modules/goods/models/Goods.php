<?php

namespace app\modules\goods\models;

use app\modules\catalog\behaviors\PriceBehavior;
use app\modules\catalog\models\Price;
use app\modules\catalog\models\Product;
use app\modules\favorite\models\FavoriteElement;
use dvizh\cart\events\CartElement;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use yii2mod\cart\models\CartItemInterface;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property integer $property_id
 * @property integer $product_id
 * @property integer $sort
 */
class Goods extends \yii\db\ActiveRecord implements \dvizh\cart\interfaces\CartElement
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    public $img;
    public $delete_img;
    const NO_IMAGE_PATH = '/images/no-image.png';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'product_id', 'sort', 'delete_img'], 'integer'],
            [['name', 'path', 'file_name', 'type', 'color'], 'string', 'max' => 255],
            [['img'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['img'], 'safe'],
            [['name'] , 'required'],

            [['price_default', 'price_default_old'
                , 'price_opt'
                , 'price_opt_old'
                , 'price_vip'
                , 'price_vip_old'], 'number'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => PriceBehavior::className(),
            ],
            'file' => [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'filesStorage' => 'fileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
                'multiple' => false,
                'attribute' => 'img',
                'uploadRelation' => 'uploadedFiles',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'file_name',
                'typeAttribute' => 'type',


                'uploadModel' => self::className()
            ],
        ];
    }

    public function getUploadedFiles()
    {
        return $this->hasOne(self::className(), ['id' => 'id']);
    }

    public function getFavorite()
    {
        return $this->hasOne(FavoriteElement::className(), ['item_id' => 'id'])->where([ 'model' => $this->model]);
    }

    public function getModel()
    {
        return self::className();
    }


    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['object_id' => 'id'])->indexBy('type');
    }

    public static function find()
    {
        $q =  \Yii::createObject(ActiveQuery::className(), [get_called_class()]);

        return $q->with('prices');
    }


    public function getThumb()
    {
        return Html::img('/' . $this->path, ['width' => '100px']);
    }

    public function getImage(){
        $path = \Yii::$app->fileStorage->baseUrl.'/'.$this->path;

        return is_file(\Yii::getAlias('@webroot').$path)?$path: self::NO_IMAGE_PATH;
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getCartElement()
    {
        return $this->hasOne(CartElement::className(), ['id' => 'item_id'])->where(['cart_element.cart_id' => \Yii::$app->cart->cart->id]);
    }

    public function getCount()
    {
        return $this->cartElement->count;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('goods', 'ID'),
            'name' => Yii::t('goods', 'Name'),
            'property_id' => Yii::t('goods', 'Property ID'),
            'product_id' => Yii::t('goods', 'Product ID'),
            'sort' => Yii::t('goods', 'Sort'),
        ];
    }

    public function upload($path = 'files')
    {
        if ($this->validate() && !empty($this->img)) {
            $dir = $path . '/' . $this->product_id;
            if (!is_dir($dir)) {
                mkdir($dir);
            }

            $name = strval(time()) . strval(+$this->id) . '.' .
                $this->img->extension;
            $this->path = ($dir . '/' . $name);

            $this->file_name = $name;
            return $this->img->saveAs($this->path);
        }
        return false;

    }


    public function getPrice()
    {
        $type = \Yii::$app->getUser()->getIdentity()->price_type;
        if(!empty($this->values[$type])) {
            $res =  $this->values[$type]->value;
        } else {
            $res = $this->values[Price::TYPE_DEFAULT]->value;
        }
        return \Yii::$app->formatter->asDecimal(is_numeric($res)?$res:0, 2);

    }

    public function getOld_price()
    {
        $type = \Yii::$app->getUser()->getIdentity()->price_type;
        if(isset($this->values[$type])) {
            $res =  $this->values[$type]->old_value;
        } else {
            $res = $this->values[Price::TYPE_DEFAULT]->old_value;
        }
        return \Yii::$app->formatter->asDecimal(is_numeric($res)?$res:0, 2);

    }

    public function getLabel()
    {
        return $this->product->name . "($this->name)";
    }

    public function getUniqueId()
    {
        return $this->id;
    }


    public function getCartId()
    {
        return $this->id;
    }

    public function getCartName()
    {
        return  $this->product->name . "($this->name)";
    }

    public function getCartPrice()
    {
        return $this->price;
    }

    //Опции продукта для выбора при добавлении в корзину
    public function getCartOptions()
    {
        return [
            '1' => [
                'name' => 'Цвет',
                'variants' => ['1' => 'Красный', '2' => 'Белый', '3' => 'Синий'],
            ],
            '2' => [
                'name' => 'Размер',
                'variants' => ['4' => 'XL', '5' => 'XS', '6' => 'XXL'],
            ]
        ];
    }
}
