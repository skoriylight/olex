<?php

namespace app\modules\catalog\widgets\frontend;

use app\modules\catalog\models\Category;
use yii\base\Widget;

Class CategoryPop extends Widget{

    public function run(){
        $model = Category::find()
            -> with(['children' => function($q){
                $q->with('children');
            }, 'attributes_t'])
            ->andWhere(['parent_id'=> null])
            ->orderBy('name')
            ->all();


        return $this->render('category-pop/index', ['model' => $model]);
    }
}