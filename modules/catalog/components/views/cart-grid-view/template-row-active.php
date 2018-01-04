<? if(isset($options['active']) && $options['active']): ?>
<div class="attr-label-gorup">

        <div class="attr-label attr-green attr-block group-el group-col-9 text-left attr-category">
            <div class="attr-icon attr-green">
                <div class="attr-toogle-icon"></div>
            </div>
            <?=$name ?>
        </div>

        <div class="attr-label attr-green attr-block group-el group-col-3 ">

            <div class="flexbox flex-align-between">
                <div class="attr-toogle-icon" style="float: left"></div>Свернуть<div class="attr-toogle-icon" style="float: right"></div>
            </div>

        </div>

</div>
<? else: ?>
<div class="attr-label-gorup">

    <div class="attr-label attr-green-light attr-block group-el group-col-9 text-left attr-category">
        <div class="attr-icon attr-green-light">
            <div class="attr-toogle-icon"></div>
        </div>
        <?=$name ?>
    </div>

    <div class="attr-label attr-green-light attr-block group-el group-col-3 ">

        <div class="flexbox flex-align-between">

        </div>

    </div>

</div>
<? endif; ?>
