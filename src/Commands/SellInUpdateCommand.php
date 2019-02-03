<?php

namespace GildedRose\Commands;

use GildedRose\Command;
use GildedRose\Product;

/**
 * Class SellInUpdateCommand
 *
 * Decreases Sell In value of Product as the day passes
 *
 * @package \GildedRose\Commands
 */
class SellInUpdateCommand extends Command
{
    /**
     * @return void
     */
    public function execute(): void
    {
        $this->product->getItem()->sell_in--;
    }
}