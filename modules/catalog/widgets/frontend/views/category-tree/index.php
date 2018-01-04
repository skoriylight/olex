
<div class="sidebar-menu">
    <ul>
        <? foreach ($model as $one): ?>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/catalog/default/index', 'category_slug' => $one->slug]) ?>">
                    <span class="sidebar-menu-icon-left"><img src="/images/icon-cover.png"></span>
                    <span class="sidebar-menu-label"><?= $one->name_t ?> (<?= $one->product_count ?>)</span>
                    <span class="sidebar-menu-icon-right"><i class=" icon-right" aria-hidden="true"></i></span>
                </a>
                <? if(count($one->children) > 0): ?>
                <span class="sidebar-menu-box-container">
                    <span class="sidebar-menu-box">
                    <span class="sidebar-modal-header">
                        <?= $one->name_t ?> (<?= $one->product_count ?>)
                    </span>
                        <? foreach ($one->children as $child): ?>



                                <a href="<?= \yii\helpers\Url::to(['/catalog/default/index', 'category_slug' => $child->slug]) ?>">
                                <h3><?= $child->name_t; ?> <span> (<?= $child->product_count; ?>)</span></h3>
                            </a>
                            <div class="row">

                            <? foreach ($child->children as $item): ?>

                                <div class="col-md-2 text-center">


                                    <a href="<?= \yii\helpers\Url::to(['/catalog/default/index', 'category_slug' => $item->slug]) ?>">
                                        <img style="width: 100%"
                                             src="<?=\Yii::$app->imageresize->getUrl(trim($item->imgUrl,'/'), 180, 180); ?>"/>

                                        <?= $item->name_t; ?> <span> (<?= $item->product_count; ?>)</span>
                                    </a>
                                </div>
                            <? endforeach ?>
                                </div>

                        <? endforeach ?>

                    </span>
                </span>
                <? endif; ?>
            </li>
        <? endforeach ?>

    </ul>
</div>