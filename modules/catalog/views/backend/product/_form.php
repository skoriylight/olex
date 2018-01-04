<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\backend\Product */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="product-form">

        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            'validateOnChange' => true,
            'validateOnBlur' => false,

            'options' => [
                'enctype' => 'multipart/form-data',
                'id' => 'dynamic-form'
            ]
        ]); ?>


        <div class="row">
            <div class="col-md-8">

                <div class="panel panel-primary">
                    <div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
                    <div class="panel-body">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>



                        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

                        <?php
                        echo $form->field($model, 'files')->widget(
                            '\trntv\filekit\widget\Upload',
                            [
                                'url' => ['upload',],
                                'sortable' => true,
                                'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                                'maxNumberOfFiles' => 3,
                                'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpe?g|png)$/i'),
                                'showPreviewFilename' => false,

                            ]
                        );

                        ?>


                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'redirect', 'value' => 'update']) ?>
                            <?= Html::submitButton($model->isNewRecord ? 'Создать и вернуться к списку' : 'Сохранить  и вернуться к списку', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'redirect', 'value' => 'index']) ?>
                            <?= Html::submitButton($model->isNewRecord ? 'Создать и перейти к товарам' : 'Сохранитьи перейти к товарам', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'redirect', 'value' => 'goods']) ?>
                        </div>

                        <div class="padding-v-md">
                            <div class="line line-dashed"></div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <?

                echo \app\modules\catalog\widgets\backend\CategoryTreeCheck::widget(['model_id' => $model->id]);
                ?>

                <?
                echo $form->field($model, 'property_ids')->widget(
                    app\modules\property\widgets\backend\PropertyForm::className(),
                    [
                        'className' => \app\modules\catalog\models\Product::className()
                    ]

                );
                ?>

                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Лэйбы</b></div>
                    <div class="panel-body">
                        <?=$form->field($model, 'attr_mark')->widget(\app\modules\attribute\widgets\MarkInput::className())->label(false) ?>
                    </div>
                </div>
            </div>
        </div>




        <?php ActiveForm::end(); ?>

    </div>

