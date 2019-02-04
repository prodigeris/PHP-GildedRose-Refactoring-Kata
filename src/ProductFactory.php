<?php

namespace GildedRose;

use GildedRose\Exceptions\FactoryClassNotAProductException;
use GildedRose\Exceptions\FactoryClassNotFoundException;
use GildedRose\Products\RegularProduct;

/**
 * Class ProductFactory
 *
 * @package \GildedRose
 */
class ProductFactory
{
    /**
     * @var \GildedRose\ProductFactoryRegistry
     */
    private $product_factory_registry;

    public function __construct(ProductFactoryRegistry $productFactoryRegistry)
    {
        $this->product_factory_registry = $productFactoryRegistry;
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
        return self::newClass($this->findProductInRegistry($item->name), $item);
    }

    protected function getProductsFromRegistry(): array
    {
        return $this->product_factory_registry->getProducts();
    }

    protected function findProductInRegistry($name): string
    {
        if (! array_key_exists($name, $this->getProductsFromRegistry())) {
            return ProductFactoryRegistry::DEFAULT_PRODUCT;
        }

        return $this->getProductsFromRegistry()[$name];
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