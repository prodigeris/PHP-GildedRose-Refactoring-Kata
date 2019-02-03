<?php

namespace GildedRose\Commands;

use GildedRose\Command;
use GildedRose\Product;

/**
 * Class ChangeQualityCommand
 *
 * Changes Product quality to a specified value
 *
 * @package GildedRose\Commands
 */
class ChangeQualityCommand extends Command
{
    /**
     * @var int
     */
    private $quality = 0;

    /**
     * @param int $quality
     * @return \GildedRose\Commands\ChangeQualityCommand
     */
    public function setQuality(int $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Execute the command
     */
    public function execute(): void
    {
        $this->product->getItem()->quality = $this->quality;
    }
}