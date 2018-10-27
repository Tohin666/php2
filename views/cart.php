<?php /** @var \app\models\Product $model */ ?>

<h1>Корзина</h1>

<?php if ($model):
    $total = null;
    ?>
    <table class="cartTable">
        <tr>
            <td>Название</td>
            <td>Количество</td>
            <td>Цена</td>
            <td>Сумма</td>
        </tr>

        <?php foreach ($model as $product):
            if (gettype($product) == 'object'): ?>
                <tr>
                    <td><?= $product->name ?></td>
                    <td><?= $product->quantity ?></td>
                    <td><?= $product->price ?> руб.</td>
                    <td><?= $product->sum ?> руб.</td>
                    <td>
                        <form action=""><input type="submit" value="Удалить" name="<?= $product->id ?>"></form>
                    </td>
                </tr>
            <?php endif; endforeach; ?>
    </table>

    <h3>Сумма к оплате: <?= $model[0] ?> руб.</h3>
    <form action=""><input type="submit" value="Заказать" name="button"></form>

<?php else:
    echo 'Корзина пуста';
endif;
?>
