<?php

namespace GildedRose\Commands;

use GildedRose\Product;

/**
 * Class SellInUpdateCommand
 *
 * Decreases Sell In value of Product as the day passes
 *
 * @package \GildedRose\Commands
 */
class SellInUpdateCommand
{
    /**
     * @var \GildedRose\Product
     */
    private $product;

    /**
     * SellInUpdateCommand constructor.
     *
     * @param \GildedRose\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->product->getItem()->sell_in--;
    }
}