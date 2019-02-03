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
    private $items;

    /**
     * GildedRose constructor.
     *
     * @param $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Updates the quality and sell in of the items in the list
     *
     * @throws \GildedRose\Exceptions\FactoryClassNotAProductException
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    public function updateQuality(): void
    {
        $productFactory = new ProductFactory();

        foreach ($this->items as $item) {
            $productFactory->build($item)->update();
        }
    }
}

