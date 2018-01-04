<div class="<?= $containerClass ?>">
    <div class="row">
        <? if($title): ?>
        <div class="col-md-2 text-center">
            <span class="menu-title"><?= $title ?></span>

            <div class="icon-white menu-title-icon"></div>

        </div>
        <? endif; ?>

        <div class="<?=($title?'col-md-10': 'col-md-12'); ?>">
            <ul class="item-list">
                <? foreach ($items as $item): ?>
                    <li class="item">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><?= $item['label'] ?></a>

                            <? if (isset($item['items'])): ?>
                                <ul class="dropdown-menu dropdown-menu-large row">
                                <? foreach ($item['items'] as $attr): ?>
                                    <li class="col-md-2">
                                        <a href="<?= isset($attr['url'])?$attr['url']:''; ?>">
                                            <?
                                            if(isset($attr['image'])) {
                                                echo \yii\helpers\Html::img(

                                                        \Yii::$app->imageresize->getUrl(trim($attr['image'],'/'), 250, 250)
                                                        ,['height' => '50px']);
                                            }
                                            ?>
                                            <?= $attr['label'] ?>
                                        </a>
                                    </li>
                                <? endforeach; ?>
                                </ul>
                            <? endif; ?>

                    </li>
                <? endforeach; ?>


            </ul>

        </div>
    </div>
</div>

<?
$this->registerJS("
$('.$containerClass [data-toggle=\"dropdown\"]').hover(function() {

  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
")
?>