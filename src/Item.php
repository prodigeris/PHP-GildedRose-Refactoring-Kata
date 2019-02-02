<?php

namespace GildedRose;

/**
 * Class Item
 *
 * @package \GildedRose
 */
class Item
{
    public $name;

    public $sell_in;

    public $quality;

    public function __construct($name, $sell_in, $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}