<?php
$box = \marekpetras\yii2ajaxboxwidget\Box::begin([
    'bodyLoad' => [$action,'modelClass' => $modelClass],
    'id' => 'property-create-box',
]);

$box->end();
?>

<?php $this->registerJs("

    $('body').on('click' , '#property-create-button',function(e){
        alert($('[name=\'PropertyName\']').val());
        e.preventDefault();
        
        var uri = 'propertyName='+$('[name=\'PropertyName\']').val();
        $('#property-create-box').box('reload',encodeURI(uri)).box('show');    
    });
    
    
    
    


"); ?>
