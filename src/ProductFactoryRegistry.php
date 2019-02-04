<?php

namespace GildedRose;

use GildedRose\Exceptions\FactoryClassNotAProductException;
use GildedRose\Products\RegularProduct;

/**
 * Class ProductFactoryRegistry
 *
 * @package \GildedRose
 */
class ProductFactoryRegistry
{
    /**
     * List of products
     * @var array
     */
    protected $products = [];

    /**
     * Fully qualified name of default product
     */
    const DEFAULT_PRODUCT = RegularProduct::class;

    /**
     * Adds a product to the list
     *
     * @param string|Product $product
     * @throws \GildedRose\Exceptions\FactoryClassNotAProductException
     */
    public function register(string $product): void
    {
        if (!is_subclass_of($product, Product::class)) {
            throw new FactoryClassNotAProductException;
        }

        $this->products[$product::NAME] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}