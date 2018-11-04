<?php /** @var \app\controllers\AdminController $model */ ?>
<?php /** @var \app\controllers\AdminController $message */ ?>

<h1>Загрузка товаров</h1>

<div><?= $message ?></div>

<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Название"><br>
    <textarea name="description" id="" cols="30" rows="10" placeholder="Описание"></textarea><br>
    <input type="text" name="price" placeholder="Цена">
    <h5>Категория:</h5>
    <select name="category_id" id="">
        <option value="1">Пластиковые автоматические печати</option>
        <option value="2">Металлические автоматические печати</option>
        <option value="3">Пластиковые автоматические штампы</option>
    </select>
    <h5>Загрузить фото:</h5>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
    <input type="file" name="loadedImage">
    <h5>Максимальный размер 3МB</h5>
    <input type="submit" value="Готово">
</form>

<h2>Товары</h2>

<table class="cartTable">
    <tr>
        <td>Название</td>
        <td>Цена</td>
    </tr>

    <?php foreach ($model as $product): ?>
        <tr>
            <td><?= $product->name ?></td>
            <td><?= $product->price ?> руб.</td>
            <td>
                <form action="">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input type="submit" value="Удалить">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
