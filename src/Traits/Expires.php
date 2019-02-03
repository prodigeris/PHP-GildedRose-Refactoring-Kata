<?php

namespace GildedRose\Traits;

use GildedRose\Commands\ChangeQualityCommand;
use GildedRose\Product;

/**
 * Trait Expires
 *
 * @package GildedRose\Traits
 */
trait Expires
{
    /**
     * Changes the quality to 0 if product is after sale
     */
    public function expiresAfterSale(): void
    {
        if ($this->isAfterSale())
        {
            /* @var $this Product */
            (new ChangeQualityCommand($this))->setQuality(0)->execute();
        }
    }
}