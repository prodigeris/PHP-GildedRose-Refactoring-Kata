<?php

namespace GildedRose\Commands;

use GildedRose\Product;

/**
 * Class QualityUpdateCommand
 *
 *  Updates quality according rules
 *
 * @package \GildedRose\Commands
 */
class QualityUpdateCommand
{
    /**
     * @var \GildedRose\Product
     */
    private $product;

    /**
     * QualityUpdateCommand constructor.
     *
     * @param \GildedRose\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
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
        (new ChangeQualityCommand($this->product))->execute(
            $this->product->getNewQuality()
        );
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
        $this->product->getItem()->quality = $this->product->getMaxQuality();
    }

    /**
     * @return void
     */
    protected function setQualityToMin(): void
    {
        $this->product->getItem()->quality = $this->product->getMinQuality();
    }
}