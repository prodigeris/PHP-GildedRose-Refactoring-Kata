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
    const NAME = 'Aged Brie';

    public function updateQuality()
    {
        $this->item->sell_in--;

        if ($this->item->quality >= 50) {
            return;
        }

        $this->item->quality++;

        if ($this->item->sell_in < 0 && $this->item->quality < 50) {
            $this->item->quality++;
        }
    }
}