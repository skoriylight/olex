<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\JuiAsset;
use yii\web\JsExpression;
use kartik\file\FileInput;
use app\modules\yii2extensions\models\Image;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\color\ColorInput;
?>



    <div class="padding-v-md">

        <div class="line line-dashed"></div>

    </div>

<?php DynamicFormWidget::begin([

    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

    'widgetBody' => '.container-items', // required: css class selector

    'widgetItem' => '.item', // required: css class

    'limit' => 5, // the maximum times, an element can be cloned (default 999)

    'min' => 1, // 0 or 1 (default 1)

    'insertButton' => '.add-item', // css class

    'deleteButton' => '.remove-item', // css class

    'model' => $modelsGoods[0],

    'formId' => 'dynamic-form',

    'formFields' => [

        'name',

        'img',

        'color',

        'is_color',

        'price_idx'



    ],

]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Items

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Item</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($modelsGoods as $index => $modelAddress): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Item: <?= ($index + 1) ?></span>

                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>

                        <div class="clearfix"></div>

                    </div>

                    <div class="panel-body">

                        <?php

                        // necessary for update action.

                        if (!$modelAddress->isNewRecord) {

                            echo Html::activeHiddenInput($modelAddress, "[{$index}]id");

                        }

                        ?>
                        <div class="row">
                            <div class="col-md-4"><?= $form->field($modelAddress, "[{$index}]name")->textInput(['maxlength' => true]) ?></div>
                            <div class="col-md-4"><?= $form->field($modelAddress, "[{$index}]color")->input('color'); ?></div>
                            <div class="col-md-4"><?= $form->field($modelAddress, "[{$index}]is_color")->checkbox() ?></div>
                        </div>


                        <?= $form->field($modelAddress, "[{$index}]price_idx")->widget(
                                \app\modules\catalog\widgets\backend\PriceForm::className(),
                                ['index' => $index]
                        ) ?>

                        <div class="row">

                            <div class="col-sm-6">

                                <?/*= $form->field($modelAddress, "[{$index}]img", ['options' => ['value' => $modelAddress->file_name]])->label(false)->widget(FileInput::classname(), [
                                    'options' => ['accept' => 'image/*'],
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => false,
                                        'showUpload' => false
                                    ]
                                ]);*/


                                ?>

                                <?
                                if ($modelAddress) {

                                    $pathImg = $modelAddress->image;

                                    $initialPreview[] = Html::img($pathImg, ['class' => 'file-preview-image', 'width' => '100px']);

                                }

                                echo $form->field($modelAddress, "[{$index}]img")->label(false)->widget(FileInput::classname(), [

                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*',
                                        'class' => 'optionvalue-img'
                                    ],

                                    'pluginOptions' => [
                                        'previewFileType' => 'image',
                                        'showCaption' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-default btn-sm',
                                        'browseLabel' => ' Pick image',
                                        'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                                        'removeClass' => 'btn btn-danger btn-sm',
                                        'removeLabel' => ' Delete',
                                        'removeIcon' => '<i class="fa fa-trash"></i>',
                                        'previewSettings' => [
                                            'image' => ['width' => '138px', 'height' => 'auto']
                                        ],
                                        'initialPreview' => $initialPreview,
                                        'layoutTemplates' => ['footer' => ''],
                                        'mainClass' => 'input-group-lg'
                                    ]

                                ]) ?>

                            </div>

                            <div class="col-sm-6">
                                <?//=Html::img('/'.$modelAddress->path, ['style' => 'max-width: 100px; max-height: 100px']) ?>
                            </div>



                        </div><!-- end:row -->



                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

<?php DynamicFormWidget::end(); ?>

<?php

$js = <<<'EOD'

/*
$(".optionvalue-img").on("filecleared", function(event) {

    alert('df');

    var regexID = /^(.+?)([-\d-]{1,})(.+)$/i;

    var id = event.target.id;

    var matches = id.match(regexID);

    if (matches && matches.length === 4) {

        var identifiers = matches[2].split("-");

        $("#optionvalue-" + identifiers[1] + "-deleteimg").val("1");

    }

});
*/

var fixHelperSortable = function(e, ui) {

    ui.children().each(function() {

        $(this).width($(this).width());

    });

    return ui;

};


$(".form-options-body").sortable({

    items: "tr",

    cursor: "move",

    opacity: 0.6,

    axis: "y",

    handle: ".sortable-handle",

    helper: fixHelperSortable,

    update: function(ev){

        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");

    }

}).disableSelection();


EOD;


//JuiAsset::register($this);

//$this->registerJs($js);

?>
