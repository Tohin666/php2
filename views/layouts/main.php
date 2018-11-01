<?php /** @var \app\controllers\Controller $content */ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://php2/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Anton Korneev - PHP2</title>
</head>
<body>
<header class="header">
    <a href="http://php2/product">Каталог</a>
    <a href="http://php2/cart">Корзина</a>
    <a href="http://php2/user">Личный кабинет</a>
    <a href="http://php2/admin">Загрузка товаров</a>

    <hr>
</header>
<div class="content"><?= $content ?></div>
<footer class="footer">
    <br>
    <hr>
    &copy; Anton Korneev - PHP2
</footer>
</body>
</html>
