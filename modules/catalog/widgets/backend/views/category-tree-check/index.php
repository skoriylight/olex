<div class="panel panel-primary">
    <div class="panel-heading">Категория</div>
    <div class="panel-body">

        <?php
        echo \yiidreamteam\jstree\JsTree::widget([
            'containerOptions' => [
                'class' => 'data-tree',
                'id' => 'category-tree',
            ],
            'jsOptions' => [
                'core' => [
                    'multiple' => true,
                    'data' => [
                        'url' => \yii\helpers\Url::to(['ajax/tree','id' => $id]),

                        [
                            'id' => '23',
                            'text' => 'text',
                            'children' => [
                                ['text' => 'child']
                            ]
                        ]
                    ],
                    'themes' => [
                        'stripes' => true
                    ],


                ],
                "checkbox" => [
                    "keep_selected_style" => false,
                    'tie_selection' => false,
                    'three_state' => false,
                    'cascade' => '',
                    //'cascade_to_disabled' => false,
                ],
                "plugins" => [
                    "checkbox"
                ],
            ]
        ]) ?>
        <div id="hidden_check"></div>
        <hr>
        <?php

        echo \yii\helpers\Html::activeDropDownList($model,'category_id', $categoryList,
            ['id' => 'product_category_id', 'class' => 'form-control']);
        ?>

    </div>
</div>