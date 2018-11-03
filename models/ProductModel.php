<?php

namespace app\models;


class ProductModel
{
    public function createShortDescriptions($products)
    {
        foreach ($products as $index => $product) {
            $shortDescription = $product->getShortDescription();
            $products[$index]->shortDescription = $shortDescription;
        }
        return $products;
    }

}