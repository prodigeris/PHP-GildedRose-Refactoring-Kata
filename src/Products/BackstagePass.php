<?php

namespace GildedRose\Products;

use GildedRose\Product;

/**
 * Class BackstagePass
 *
 * @package \GildedRose\Products
 */
class BackstagePass extends Product
{
    const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public function updateQuality()
    {
        $this->item->sell_in--;

        if ($this->item->sell_in < 0) {
            $this->item->quality = 0;

            return;
        }

        if ($this->item->quality >= 50) {
            return;
        }

        $this->item->quality++;

        if ($this->item->sell_in < 10 && $this->item->quality < 50) {
            $this->item->quality++;
        }

        if ($this->item->sell_in < 5 && $this->item->quality < 50) {
            $this->item->quality++;
        }
    }
}