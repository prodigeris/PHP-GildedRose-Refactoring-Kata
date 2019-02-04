<?php

namespace GildedRose\Commands;

use GildedRose\Command;
use GildedRose\Product;

/**
 * Class QualityUpdateCommand
 *
 *  Updates quality according rules
 *
 * @package \GildedRose\Commands
 */
class QualityUpdateCommand extends Command
{
    /**
     * @var ChangeQualityCommand
     */
    private $change_quality_command;

    /**
     * QualityUpdateCommand constructor.
     *
     * @param Product $product
     * @param ChangeQualityCommand $changeQualityCommand
     */
    public function __construct(Product $product, ChangeQualityCommand $changeQualityCommand)
    {
        parent::__construct($product);

        $this->change_quality_command = $changeQualityCommand;
    }

    /**
     * Execute the command
     *
     * @return void
     */
    public function execute(): void
    {
        $this->changeToNewQuality();

        if ($this->isQualityHigherThanMax()) {
            $this->setQualityToMax();
        }
        if ($this->isQualityLowerThanMin()) {
            $this->setQualityToMin();
        }
    }

    /**
     * @return void
     */
    protected function changeToNewQuality(): void
    {
        $this->change_quality_command->setQuality(
            $this->product->getNewQuality()
        )->execute();
    }

    /**
     * @return bool
     */
    protected function isQualityHigherThanMax(): bool
    {
        return $this->product->getItem()->quality > $this->product->getMaxQuality();
    }

    /**
     * @return bool
     */
    protected function isQualityLowerThanMin(): bool
    {
        return $this->product->getItem()->quality < $this->product->getMinQuality();
    }

    /**
     * @return void
     */
    protected function setQualityToMax(): void
    {
        $this->change_quality_command->setQuality(
            $this->product->getMaxQuality()
        )->execute();
    }

    /**
     * @return void
     */
    protected function setQualityToMin(): void
    {
        $this->change_quality_command->setQuality(
            $this->product->getMinQuality()
        )->execute();
    }
}