<?php /** @var \app\controllers\ProductController $model */ ?>

<strong>Категории:</strong>
<a href="http://php2/product/category?id=1">Пластиковые автоматические печати</a>
<a href="http://php2/product/category?id=2">Металлические автоматические печати</a>
<a href="http://php2/product/category?id=3">Пластиковые автоматические штампы</a>
<h1><?= $model->name ?></h1>
<h4>Категория: <?= $model->category_name ?></h4>
<a href="http://php2/img/<?= $model->photo ?>" target="_blank">
    <img src="http://php2/img/<?= $model->photo ?>" alt="<?= $model->name ?>" style="width: 400px"></a>
<p style="width: 600px"><?= $model->description ?></p>
<h2><?= $model->price ?> руб.</h2>

<form action="" method="post">
    <label>Количество:<input type="number" value="1" name="quantity"></label>
    <input type="hidden" name="id" value="<?= $model->id ?>">
    <input type="submit" value="Купить">
</form>
<?= $model->addToCartMessage ?>
