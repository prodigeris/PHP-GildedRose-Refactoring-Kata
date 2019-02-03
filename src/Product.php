<?php

namespace GildedRose;

/**
 * Class Product
 *
 * @package \GildedRose
 */
abstract class Product
{
    const NAME = '';

    protected static $max_quality = 50;

    protected static $min_quality = 0;

    /**
     * @var \GildedRose\Item
     */
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    abstract public function updateQuality();
}