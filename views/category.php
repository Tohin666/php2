<?php /** @var \app\controllers\ProductController $model */ ?>
<?php /** @var \app\controllers\ProductController $category */ ?>

<strong>Категории:</strong>
<a href="http://php2/product/category?id=1">Пластиковые автоматические печати</a>
<a href="http://php2/product/category?id=2">Металлические автоматические печати</a>
<a href="http://php2/product/category?id=3">Пластиковые автоматические штампы</a>
<h1>Категория: <?= $category->name?></h1>
<div style="display: flex;">
    <?php foreach ($model as $product): ?>

        <div style="width: 200px; margin: 0 20px;">
            <a href="http://php2/product/card?id=<?= $product->id ?>">
                <img src="http://php2/img/small/<?= $product->photo ?>"
                     alt="<?= $product->name ?>">
                <h2><?= $product->name ?></h2>
            </a>
            <h3><?= $product->price ?> руб.</h3>
            <p><?= $product->shortDescription ?>...</p>
        </div>

    <?php endforeach; ?>
</div>
