<?php /** @var \app\controllers\ProductController $model */ ?>

<div style="display: flex;">
    <?php foreach ($model as $product): ?>

        <div style="width: 200px; margin: 0 20px;">
            <a href="http://php2/product/card?id=<?= $product->id ?>">
                <img src="img/small/<?= $product->photo ?>"
                     alt="<?= $product->name ?>">
                <h2><?= $product->name ?></h2>
            </a>
            <h3><?= $product->price ?> руб.</h3>
            <p><?= $product->shortDescription ?>...</p>
        </div>

    <?php endforeach; ?>
</div>
