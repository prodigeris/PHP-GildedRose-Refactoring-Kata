<?php

namespace GildedRose\Traits;

/**
 * Trait HasDayRangeMultiplier
 *
 * @package GildedRose\Traits
 */
trait HasDayRangeMultiplier
{
    /**
     * Finds a nearest multiplier
     *
     * @return int
     */
    public function getMultiplier(): int
    {
        $multiplier = 1;

        foreach (static::$day_range_multiplier as $day => $dayMultiplier) {
            if ($this->getItem()->sell_in < $day) {
                $multiplier = $dayMultiplier;
            }
        }

        return $multiplier;
    }
}