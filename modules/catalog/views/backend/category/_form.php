<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\main\widgets\TranslateForm;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="category-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'method' => 'POST',
        'options' => [
            'class' => 'form-horizontal',
            'id' => 'category-form-update'
        ],
        'fieldConfig' => [
            'labelOptions' => [
                'class' => 'col-md-2',
            ],

            'template' => "{label}<div class='col-md-10'>{input}\n{hint}\n{error}</div>"

        ]
    ]); ?>



    <?= $form->field($model, 'translate_t')->widget(TranslateForm::className(), [
        'typeFields' => [
            'content' => 'editor',
        ]
    ]);

    ?>

    <?/*= $form->field($model, 'image_url')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); */?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-4">
                    Иконка
                </label>
                <div class="col-md-8">
                    <?php
                    echo \trntv\filekit\widget\Upload::widget(
                        [
                            'model' => $model,
                            'attribute' => "icon",
                            'multiple' => false,
                            'url' => ['upload'],
                            'sortable' => false,
                            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                            'maxNumberOfFiles' => 1,
                        ]);

                    ?>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-4">Изображение</label>
                <div class="col-md-8">
                    <?php
                    echo \trntv\filekit\widget\Upload::widget(
                        [
                            'model' => $model,
                            'attribute' => "img",
                            'multiple' => false,
                            'url' => ['upload'],
                            'sortable' => false,
                            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                            'maxNumberOfFiles' => 1,
                        ]);
                    ?>
                </div>
            </div>

        </div>
    </div>




    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>



    <?= Html::hiddenInput('id', $model->id); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('catalog', 'Create') : Yii::t('catalog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
