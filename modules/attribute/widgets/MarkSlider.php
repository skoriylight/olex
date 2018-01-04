<?php

namespace app\modules\attribute\widgets;

use app\modules\catalog\models\Product;
use yii\base\Widget;
use yii\helpers\Url;

Class MarkSlider extends Widget{

    const MARK_SALE = 'is_sale';
    const MARK_STOCK = 'is_stock';
    const MARK_NEW = 'is_new';
    const MARK_HIT = 'is_hit';
    const MARK_COMING = 'is_coming';

    private $label_class = null;
    private $icon__class = null;
    public $label_mark_icon = null;
    public $label_mark_label = null;


    public $mark_name;

    public function run(){
        $label_class = 'attr-coming';
        switch ($this->mark_name){
            case self::MARK_SALE: $label_class = 'attr-sale'; $url = Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_sale]' => 1]); break;
            case self::MARK_STOCK: $label_class = 'attr-stock'; $url = Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_stock]' => 1]); break;
            case self::MARK_NEW: $label_class = 'attr-new'; $url = Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_new]' => 1]); break;
            case self::MARK_HIT: $label_class = 'attr-hit'; $url = Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_hit]' => 1]); break;
            case self::MARK_COMING: $label_class = 'attr-coming'; $url = Url::to(['/catalog/default/index', 'ProductSearch[attr_mark][is_coming]' => 1]); break;
        }

        //$model = Product::find()->joinWith('mark')->where(['mark.'.$this->mark_name => 1])->all();

        $model = Product::find()->joinWith('mark')->limit(10)->all();


        return $this->render('mark-slider/index', [
            'model' => $model,
            'label_mark_icon' => $this->label_mark_icon,
            'label_mark_label' => $this->label_mark_label,
            'label_class' => $label_class,
            'url' => $url
        ]);

    }
}