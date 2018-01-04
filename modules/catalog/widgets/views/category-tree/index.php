<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\catalog\models\Category;

?>

<div class="row">
    <div class="col-md-3">

        <div class="panel panel-primary">
            <div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
            <div class="panel-body">
                <?php
                $url = \yii\helpers\Url::to('/admin/catalog/category/index');
                $box = \marekpetras\yii2ajaxboxwidget\Box::begin([
                    'bodyLoad' => ['/admin/catalog/category/update-tree'],
                    'id' => 'category-tree-box',
                    'clientOptions' => [
                        'method' => 'POST'
                    ],

                ]);

                $box->end();
                ?>
                <a id="create-category" href="<?= $url ?>" class="btn btn-info"><?= \Yii::t('catalog', 'create category') ?></a>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <?php
        /* $box = \marekpetras\yii2ajaxboxwidget\Box::begin([
             'bodyLoad' => ['/admin/catalog/category/update'],
             'id' => 'category-form-box',
             'clientOptions' => [

               //  'onload' => new \yii\web\JsExpression('function(box, status) { alert("load"); }'), // nothing by default
             ],
         ]);

         $box->end();*/
        echo $this->render('@app/modules/catalog/views/backend/category/update', ['model' => $model])
        ?>
    </div>
</div>

<?php $this->registerJs("

    /*$('body').on('submit' , '#category-form-update',function(e){
        alert('submit form');
        e.preventDefault();
        var data = $(this).serialize(); // this will be loaded via post on submit  
        $('#category-form-box').box('reload',data).box('show');  
         $('#category-tree-box').box('reload', '').box('show');     
    });*/
    
    
$('body').on(
    'tree.click',
    '#treeview',
    function(event) {
        // The clicked node is 'event.node'
        var node = event.node;
        var uri = 'id='+node.id;
        //$('#category-form-box').box('reload',encodeURI(uri)).box('show');
        location.href = '{$url}?'+uri;
               
    }
); 

$('body').on(
    'tree.move',
    '#treeview',
    function(event) {
        console.log('moved_node', event.move_info.moved_node);
        console.log('target_node', event.move_info.target_node);
        console.log('position', event.move_info.position);
        console.log('previous_parent', event.move_info.previous_parent);
        var _move_id = event.move_info.moved_node.id;
        var _id = event.move_info.target_node.id;
        var _position = event.move_info.position;
        $.ajax({
        url: '" . \yii\helpers\Url::to(['/admin/catalog/category/move']) . "',
        data: 'move_id='+_move_id+'&id='+_id+'&position='+_position,
        });
        
      }
    
);

$('#create-category').on('click', function(){
var data = 'id=0';
$('#category-form-box').box('reload',data).box('show');      
});



$('body').on(
        'click', '#treeview .edit',
        function(e) {
            // Get the id from the 'node-id' data property
            var node_id = $(e.target).data('node-id');

            // Get the node from the tree
            var node = $('#treeview').tree('getNodeById', node_id);

            $.ajax({
                url: '" . \yii\helpers\Url::to(['/admin/catalog/category/delete-node']) . "',
                data: 'id='+node_id,
                success: function(){
                    var data = 'id=0';
                    $('#category-form-box').box('reload',data).box('show');   
                    $('#category-tree-box').box('reload','').box('show');   
                }
            });
        }
    );


"); ?>


