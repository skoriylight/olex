
<?= $form->field($model, 'shipping_type_id')->radioList(\Yii::$app->order->shippingList, [
    'item' => function ($index, $label, $name, $checked, $value) {
        $model = \app\modules\order\models\OrderShippingType::findOne(['id' => $value]);


        return
            \yii\helpers\Html::tag('div', '', [
                'style' => 'height: 45px; 
                width: 45px;
                 background-image: url("' . $model->imageUrl . '"); 
                 background-size: contain; 
                 display: inline-block; 
                 background-position: center center;
                 background-repeat: no-repeat'
            ]) .
            \bookin\aws\checkbox\AwesomeCheckbox::widget(

                [
                    'name' => $name,
                    // 'label' => $label,
                    'checked' => $checked,
                    'type' => \bookin\aws\checkbox\AwesomeCheckbox::TYPE_RADIO,
                    // 'labelOptions' => ['class' => 'niceInput']
                    'options' => [
                        'class' => 'checkbox',
                        'label' => $label,
                        'value' => $value,
                    ],
                    'wrapperOptions' => [
                        'class' => 'checkbox',

                    ],
                ]
            ) . $this->render('extra_field', ['idx' => $value]);;


    }
])->label(false) ?>


