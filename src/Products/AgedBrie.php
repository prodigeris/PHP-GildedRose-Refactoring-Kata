<?php

namespace GildedRose\Products;

use GildedRose\Product;

/**
 * Class AgiedBrie
 *
 * @package \GildedRose\Products
 */
class AgedBrie extends Product
{
    /**
     * The name of the product
     */
    const NAME = 'Aged Brie';

    /**
     * Quality increases by 1 over time
     *
     * @var int
     */
    protected static $quality_step = 1;
}