<?php

namespace GildedRose\Products;

use GildedRose\Product;

/**
 * Class RegularProduct
 *
 * @package \GildedRose\Products
 */
class RegularProduct extends Product
{
    const NAME = 'Regular Product';

    public function updateQuality()
    {
        $this->item->sell_in--;

        if ($this->item->quality === 0) {
            return;
        }

        $this->item->quality--;

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
            $this->item->quality--;
        }
    }
}