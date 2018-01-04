<?
use app\modules\catalog\models\Price;
use yii\bootstrap\Html;
?>

<table class="table">
    <tr>
        <th></th>
        <th>Default price</th>
        <th>Opt Price</th>
        <th>VIP Price</th>
    </tr>

    <tr>
        <td>Price</td>
        <td><?= Html::activeTextInput($model, "{$index}price_default", ['class' => 'form-control']); ?></td>
        <td><?= Html::activeTextInput($model, "{$index}price_opt", ['class' => 'form-control']); ?></td>
        <td><?= Html::activeTextInput($model, "{$index}price_vip", ['class' => 'form-control']); ?></td>

    </tr>
    <tr>
        <td>Old Price</td>
        <td><?= Html::activeTextInput($model, "{$index}price_default_old", ['class' => 'form-control']); ?></td>
        <td><?= Html::activeTextInput($model, "{$index}price_opt_old", ['class' => 'form-control']); ?></td>
        <td><?= Html::activeTextInput($model, "{$index}price_vip_old", ['class' => 'form-control']); ?></td>
    </tr>


</table>
