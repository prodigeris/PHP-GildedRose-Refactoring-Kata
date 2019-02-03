<?php

namespace GildedRose;

use GildedRose\Commands\QualityUpdateCommand;
use GildedRose\Commands\SellInUpdateCommand;
use GildedRose\Traits\HasDayRangeMultiplier;

/**
 * Class Product
 *
 * @package \GildedRose
 */
abstract class Product
{
    /* DEFAULT VALUES OF A PRODUCT */

    /**
     *  The name of the product
     */
    const NAME = '';

    /**
     * Quality cannot go over this value
     *
     * @var int
     */
    protected static $max_quality = 50;

    /**
     * Quality cannot go below this value
     *
     * @var int
     */
    protected static $min_quality = 0;

    /**
     * Quality step -- decreases by 1 over time
     *
     * @var int
     */
    protected static $quality_step = -1;

    /**
     * Default day range.
     *
     * After sale date; it's twice as fast
     *
     * @var array
     */
    protected static $day_range_multiplier = [
        '0' => 2,
    ];

    use HasDayRangeMultiplier;

    /* END OF DEFAULT VALUES OF A PRODUCT */

    /**
     * @var \GildedRose\Item
     */
    protected $item;

    /**
     * Product constructor.
     *
     * @param \GildedRose\Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     *  Updates sell in and quality values using
     *  respective commands.
     */
    public function update(): void
    {
        (new SellInUpdateCommand($this))->execute();
        (new QualityUpdateCommand($this))->execute();
    }

    /**
     * Returns items
     *
     * @return \GildedRose\Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * Returns max quality of the product
     *
     * @return int
     */
    public static function getMaxQuality(): int
    {
        return static::$max_quality;
    }

    /**
     * Returns min quality of the product
     *
     * @return int
     */
    public static function getMinQuality(): int
    {
        return static::$min_quality;
    }

    /**
     * Returns quality step of the product
     * depending on multipliers set.
     *
     * @return int
     */
    public function getQualityStep(): int
    {
        return static::$quality_step * $this->getMultiplier();
    }

    /**
     * Returns the quality with a step
     *
     * @return int
     */
    public function getNewQuality(): int
    {
        return $this->item->quality + $this->getQualityStep();
    }

    /**
     * Returns if the product has passed the sale
     *
     * @return bool
     */
    public function isAfterSale(): bool
    {
        return $this->item->sell_in < 0;
    }
}