<?php /** @var \app\controllers\CartController $model */ ?>

<h1>Корзина</h1>

<?php if ($model): ?>
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
                        <form action="">
                            <input type="submit" value="Удалить" name="button">
                            <input type="hidden" value="<?= $product->product_id ?>" name="id">
                        </form>
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
