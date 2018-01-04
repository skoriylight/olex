<?php
use app\modules\main\components\Tr;
use yii\helpers\Html;
?>
<a class="attr-label attr-green attr-block" href="#" data-role="catalog-pop">
    <div class="attr-icon attr-green">
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </div><?=Tr::t('catalog-main','ALPHABETICALLY') ?>
</a>


<div class="category-pop-container">
    <div class="category-pop-box">
<? $l = '' ?>
    <? foreach ($model as $item): ?>
        <?
        $_l = mb_substr($item->name, 0, 1);
        if($_l !== $l){
            echo '<ul>';
            echo "<li class='category-pop-letter'>$_l</li>";
        }
    echo "<li class='category-pop-title'><b>".
        Html::a($item->name,['/catalog/default/index','category_slug' => $item->slug])
        ."</b></li>";
        ?>

            <? foreach ($item->children as $child1): ?>

        <?
        echo "<li class='category-pop-title'>".
            Html::a($child1->name,['/catalog/default/index','category_slug' => $child1->slug])
            ."</li>";
        ?>
                <? foreach ($child1->children as $child2): ?>
            <?
            echo "<li class='category-pop-title'>".
                Html::a($child1->name.', '.$child2->name,['/catalog/default/index','category_slug' => $child2->slug])
                ."</li>";
            ?>
                <? endforeach; ?>

            <? endforeach; ?>
    <?
    if($_l !== $l){
        echo '</ul>';
        $l = $_l;
        }
    ?>
    <? endforeach; ?>

    </div>
</div>
