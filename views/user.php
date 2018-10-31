<h1>Личный кабинет</h1>
<h2><?= $user['login'] ?></h2>
<h3><?= $user['name'] ?></h3>
<h3>Привет, <?= $user['name'] ?>!</h3>

<?php if ($createOrder): ?>
    <h2>Новый заказ</h2>
    <h3>Состав заказа</h3>

    <table class="cartTable">
        <tr>
            <td>Название</td>
            <td>Количество</td>
            <td>Цена</td>
            <td>Сумма</td>
        </tr>

        <?php foreach ($cartArray as $product):
            if (gettype($product) == 'array'): ?>
                <tr>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td><?= $product['price'] ?> руб.</td>
                    <td><?= $product['sum'] ?> руб.</td>
                </tr>
            <?php endif; endforeach; ?>
    </table>

    <h3>Сумма к оплате: <?= $cartArray[0] ?> руб.</h3>

    <form action="" method="post">
        <input type="text" name="fio" placeholder="ФИО получателя">
        <input type="text" name="address" placeholder="Адрес доставки">
        <input type="text" name="phone" placeholder="Телефон">
        <input type="submit" value="Оплатить">
    </form>
    <?= $message ?>
<?php endif; ?>

<?php if ($model): ?>
    <h2>Заказы:</h2>

    <?php foreach ($model as $order): ?>
        <hr>
        <h3>Заказ №<?= $order->id ?></h3>
        <h4 id="orderStatusID<?= $order->id ?>">Статус: <?= $order->status ?></h4>
        <h3>Состав заказа:</h3>

        <table class="cartTable">
            <tr>
                <td>Название</td>
                <td>Количество</td>
                <td>Цена</td>
                <td>Сумма</td>
            </tr>

            <?php foreach ($order->products as $product): ?>
                <tr>
                    <td><?= $product->name ?></td>
                    <td><?= $product->quantity ?></td>
                    <td><?= $product->price ?> руб.</td>
                    <td><?= $product->sum ?> руб.</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Сумма заказа: <?= $order->sum ?> руб.</h3>

        <ul>
            <li>Ф.И.О. получателя: <?= $order->fio ?></li>
            <li>Адрес доставки: <?= $order->address ?></li>
            <li>Телефон: <?= $order->phone ?></li>
        </ul>

        <button data-id="<?= $order->id ?>" class="deleteOrderButton">Удалить заказ</button>

        <script>
            $(function () {
                $(".deleteOrderButton").on('click', function () {
                    var id = $(this).data('id');
                    $.ajax({
                        url: "/lesson8/public/account/deleteOrder",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.success == 'ok') {
                                $(response.markOrder).text("Статус: удален")

                            }
                        }
                    })
                })
            })
        </script>

    <?php endforeach;
endif; ?>
