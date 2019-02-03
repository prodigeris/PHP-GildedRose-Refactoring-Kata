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
     * @throws \GildedRose\Exceptions\FactoryClassNotAProductException
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    public function updateQuality(): void
    {
        $productFactory = new ProductFactory();

        foreach ($this->items as $item) {
            $productFactory->build($item)->updateQuality();
        }
    }
}

