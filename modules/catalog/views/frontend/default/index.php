<?php
use yii\widgets\ListView;

$this->params['category_id'] = $category_id;
$this->params['z_index_item'] = 100;
$this->params['filter_container'] = true;
$this->params['carousel_container'] = true;
$this->params['category_container'] = true;
?>

<div class="catalog-default-index" id="catalog-list-box">

    <?=\app\modules\attribute\widgets\MarkFilterForm::widget([
            'category_id' => $category_id
    ]); ?>
    <div class="margin-block"></div>

    <?php
    \yii\widgets\Pjax::begin([
            'id' => 'catalog-container',
        'timeout' => 50000
    ]);
    echo ListView::widget([
        'id' => 'catalog-list',
        'dataProvider' => $dataProvider,
        /*'options'      => [
           // 'tag'   => 'ol',
            'class' => 'cataloglist',
        ],*/
        'itemOptions' => [
            'tag' => false,


        ],
        'itemView' => '_item',
        /*'pager'        => [
            'class' => 'mranger\load_more_pager\LoadMorePager',
            'id' => 'catalog-list-pagination',
            'contentSelector' => '#catalog-list',
            'contentItemSelector' => '.item-sector',
            'buttonText'          => 'Load More', // Текст на кнопке пагинации
            'template'            => '<div class="text-center">{button}</div>{prevPage}{firstPage}{firstEllipsis}{pageRange}{lastEllipsis}{lastPage}{nextPage}', // Шаблон вывода кнопки пагинации
        ],*/
    ]);
    \yii\widgets\Pjax::end();
    ?>


</div>





