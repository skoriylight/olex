<?php

namespace app\modules\catalog\forms\frontend\search;

use app\modules\catalog\models\Category;
use app\modules\property\models\Value;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\backend\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\catalog\models\backend\Product`.
 */
class CategoryFilterSearch extends Category
{


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function behaviors()
    {
        return [];
    }


}
