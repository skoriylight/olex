<table class="table table-condensed table-striped" >
    <?foreach ($model as $one): ?>
    <tr>
        <td><?=$one['name']; ?></td>
        <td><?=implode(', ', $one['values']); ?></td>
    </tr>
    <? endforeach; ?>
</table>