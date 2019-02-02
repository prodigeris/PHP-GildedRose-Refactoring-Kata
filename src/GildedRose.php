<?php

namespace GildedRose;

class GildedRose
{
    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {

            if (! in_array($item->name, [
                'Aged Brie',
                'Backstage passes to a TAFKAL80ETC concert',
                'Sulfuras, Hand of Ragnaros',
            ])) {
                self::updateNormalQuality($item);

                return;
            }

            if ($item->name === 'Aged Brie') {
                self::updateAgedBrieQuality($item);

                return;
            }

            if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                self::updateSulfurasQuality($item);

                return;
            }

            if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                self::updateBackstagePassQuality($item);

                return;
            }
        }
    }

    protected static function updateNormalQuality(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality === 0) {
            return;
        }

        $item->quality--;

        if ($item->sell_in < 0 && $item->quality > 0) {
            $item->quality--;
        }
    }

    protected static function updateSulfurasQuality(Item $item): void
    {
    }

    protected static function updateAgedBrieQuality(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality >= 50) {
            return;
        }

        $item->quality++;

        if ($item->sell_in < 0 && $item->quality < 50) {
            $item->quality++;
        }
    }

    protected static function updateBackstagePassQuality(Item $item): void
    {
        $item->sell_in--;

        if ($item->sell_in < 0) {
            $item->quality = 0;

            return;
        }

        if ($item->quality >= 50) {
            return;
        }

        $item->quality++;

        if ($item->sell_in < 10 && $item->quality < 50) {
            $item->quality++;
        }

        if ($item->sell_in < 5 && $item->quality < 50) {
            $item->quality++;
        }
    }
}

