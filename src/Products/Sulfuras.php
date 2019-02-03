<?php

namespace GildedRose\Products;

use GildedRose\Item;
use GildedRose\Product;

/**
 * Class Sulfuras
 *
 * @package \GildedRose\Products
 */
class Sulfuras extends Product
{
    /**
     * The name of the product
     */
    const NAME = 'Sulfuras, Hand of Ragnaros';

    /**
     *  The quality is always 80
     *  no matter what
     */
    const QUALITY = 80;

    /**
     * Sulfuras constructor.
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $item->quality = self::QUALITY;

        parent::__construct($item);
    }

    /**
     * Do nothing
     */
    public function update(): void
    {
    }
}