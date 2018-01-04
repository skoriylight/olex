<?php
use app\modules\main\components\Tr;
?>
<div class="catalog-menu-block">
    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 text-center">
            <a class="mark-block-catalog flexbox flex-vertical-center flex-align-center">
                <div class="normal-mark-label"><i class="icon-catalog-down"></i></div>
                <span class="mark-text-catalog"><?=Tr::t('catalog-main', 'CATALOG_GOODS') ?></span>

            </a>
        </div>
        <!--                    верхнее меню-->
        <div class="col-sm-10 col-md-10 col-lg-10  ">
            <div class="one-line-menu-wrap" id="my-top-menu">
                <ul class="one-line-menu" id="down-menu">

                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="dropdown-list" data-parent="top-menu">

            </div>
        </div>
    </div>
</div>