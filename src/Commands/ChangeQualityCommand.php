<?php

namespace GildedRose\Commands;

use GildedRose\Product;

/**
 * Class ChangeQualityCommand
 *
 * Changes Product quality to a specified value
 *
 * @package GildedRose\Commands
 */
class ChangeQualityCommand
{
    /**
     * @var \GildedRose\Product
     */
    private $product;

    /**
     * ChangeQualityCommand constructor.
     *
     * @param \GildedRose\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param int $quality
     */
    public function execute(int $quality): void
    {
        $this->product->getItem()->quality = $quality;
    }
}