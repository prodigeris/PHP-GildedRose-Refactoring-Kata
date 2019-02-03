<?php

namespace GildedRose;

use GildedRose\Exceptions\FactoryClassNotAProductException;
use GildedRose\Exceptions\FactoryClassNotFoundException;
use GildedRose\Products\AgedBrie;
use GildedRose\Products\BackstagePass;
use GildedRose\Products\RegularProduct;
use GildedRose\Products\Sulfuras;

/**
 * Class ProductFactory
 *
 * @package \GildedRose
 */
class ProductFactory
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
     * ProductFactory constructor.
     *
     * Register Products here
     *
     * @throws \GildedRose\Exceptions\FactoryClassNotAProductException
     */
    public function __construct()
    {
        $this->register(BackstagePass::class);
        $this->register(Sulfuras::class);
        $this->register(AgedBrie::class);
        $this->register(RegularProduct::class);
    }

    /**
     * Adds a product to the list
     *
     * @param string|Product $product
     * @throws \GildedRose\Exceptions\FactoryClassNotAProductException
     */
    private function register(string $product): void
    {
        if (!is_subclass_of($product, Product::class)) {
            throw new FactoryClassNotAProductException;
        }

        $this->products[$product::NAME] = $product;
    }

    /**
     * Returns built product
     *
     * @param \GildedRose\Item $item
     * @return \GildedRose\Product
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    public function build(Item $item): Product
    {
        if (array_key_exists($item->name, $this->products)) {
            return self::newClass($this->products[$item->name], $item);
        }

        return self::newClass(self::DEFAULT_PRODUCT, $item);
    }

    /**
     * Creates the class of a product
     *
     * @param string $className
     * @param Item $item
     * @return \GildedRose\Product
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    protected static function newClass(string $className, Item $item): Product
    {
        if (! class_exists($className)) {
            throw new FactoryClassNotFoundException;
        }

        return new $className($item);
    }
}