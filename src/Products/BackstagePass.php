<?php

namespace GildedRose\Products;

use GildedRose\Product;
use GildedRose\Traits\Expires;

/**
 * Class BackstagePass
 *
 * @package \GildedRose\Products
 */
class BackstagePass extends Product
{
    /**
     *  The name of the product
     */
    const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    /**
     * Quality increases by 1 over time
     *
     * @var int
     */
    protected static $quality_step = 1;

    /**
     * The multiplier
     *
     * @var array
     */
    protected static $day_range_multiplier = [
        '10' => 2,
        '5' => 3,
    ];

    use Expires;

    /**
     * Updates sell in, quality and expires after sale
     */
    public function update(): void
    {
        parent::update();
        $this->expiresAfterSale();
    }
}