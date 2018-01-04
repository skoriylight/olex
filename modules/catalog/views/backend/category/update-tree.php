<?php

echo  \forecho\jqtree\JQTree::widget([
    'id' => 'treeview',
    'data' => $data,
    'dragAndDrop' => true,
    'selectable' => true,
    'saveState' => true,
    'autoOpen' => true,
    'htmlOptions' => ['class' => 'list-unstyled'],
    'onCreateLi' => new \yii\web\JsExpression('function(node, $li) { 
    
    $li.find(\'.jqtree-element\')
    .append(\'<a href="#node-\'+ node.id +\'" class="edit" style="float: right" data-node-id="\'+node.id +\'">'.\Yii::t('app-main', 'delete').'</a>\'); 
    }')
]);