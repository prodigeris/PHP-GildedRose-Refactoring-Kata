<?php

namespace GildedRose;

/**
 * Class GildedRose
 *
 * @package GildedRose
 */
class GildedRose
{
    /**
     * List of items
     *
     * @var
     */
    private static $items = [];

    /**
     * @var \GildedRose\ProductFactory
     */
    public static $product_factory;

    /**
     * GildedRose constructor.
     *
     * @param array $items
     * @param ProductFactory $productFactory
     */
    public function __construct(array $items, ProductFactory $productFactory)
    {
        static::$items = $items;
        static::$product_factory = $productFactory;
    }

    /**
     * Updates the quality and sell in of the items in the list
     *
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    public static function updateQuality(): void
    {
        foreach (static::$items as $item) {
            static::$product_factory->build($item)->update();
        }
    }
}

