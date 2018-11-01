<?php /** @var \app\controllers\UserController $model */ ?>

<h1>Вход в личный кабинет</h1>
<div><?= $model['message'] ?></div>
<form action="" method="post">
    <input type="text" name="login" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <input type="submit" name="button" value="Войти">
</form>

<h2>Регистрация</h2>
<form action="" method="post">
    <input type="text" name="name" placeholder="Имя">
    <input type="text" name="login" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <input type="submit" name="button" value="Зарегистрироваться">
</form>
