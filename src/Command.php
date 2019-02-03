<?php

namespace GildedRose;

/**
 * Class Command
 *
 * @package \GildedRose
 */
abstract class Command
{
    /**
     * @var \GildedRose\Product
     */
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    abstract function execute(): void;
}