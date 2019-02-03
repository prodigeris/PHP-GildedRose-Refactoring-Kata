<?php

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

/**
 * Class GildedRoseTest
 *
 * @package Tests
 */
class GildedRoseTest extends TestCase
{
    /**
     * @param string $name
     * @param array $array
     * @return array
     */
    private static function addNameToDataSet(string $name, array $array): array
    {
        return array_map(function ($dataSet) use ($name) {
            array_unshift($dataSet, $name);

            return $dataSet;
        }, $array);
    }

    /**
     * @return array
     */
    public function regularItemDataProvider(): array
    {
        return self::addNameToDataSet('+5 Dexterity Vest', [
            // sellIn, quality, expectedSellIn, expectedQuality
            'simple decrease in quality and sellIn' => [6, 23, 5, 22],
            'quality decreases twice on the sale date' => [0, 20, -1, 18],
            'quality decreases twice after the sale date' => [-5, 20, -6, 18],
            'quality cannot go below 0' => [2, 0, 1, 0],
            'quality cannot go below 0 when it decreases twice' => [0, 1, -1, 0],
        ]);
    }

    /**
     * @return array
     */
    public function agedBrieDataProvider(): array
    {
        return self::addNameToDataSet('Aged Brie', [
            // sellIn, quality, expectedSellIn, expectedQuality
            'increase in quality and decrease in sellIn' => [2, 10, 1, 11],
            'quality doesnt go above max' => [8, 50, 7, 50],
            'quality decreases twice after sale date' => [0, 10, -1, 12],
            'quality doesnt go above max on the sale date when its near max' => [0, 49, -1, 50],
            'updates quality after sale date' => [-10, 10, -11, 12],
        ]);
    }

    /**
     * @return array
     */
    public function sulfurasDataProvider(): array
    {
        return self::addNameToDataSet('Sulfuras, Hand of Ragnaros', [
            // sellIn, quality, expectedSellIn, expectedQuality
            'doesnt change before sale date' => [5, 80, 5, 80],
            'doesnt change on sale date' => [0, 80, 0, 80],
            'doesnt change after sale date' => [-5, 80, -5, 80],
        ]);
    }

    /**
     * @return array
     */
    public function backstagePassesDataProvider(): array
    {
        return self::addNameToDataSet('Backstage passes to a TAFKAL80ETC concert', [
            // sellIn, quality, expectedSellIn, expectedQuality
            '11 days before quality increases regularly' => [11, 10, 10, 11],
            '10 days before quality increases faster' => [10, 10, 9, 12],
            'faster increase doesnt go past max' => [10, 50, 9, 50],
            'faster increase doesnt go past max when quality near max' => [10, 49, 9, 50],
            '5 days before even faster increase' => [5, 10, 4, 13],
            'even faster increase doesnt go past max' => [5, 50, 4, 50],
            'even faster increase doesnt go past max when quality near max' => [5, 49, 4, 50],
            '1 days before even faster increase' => [1, 20, 0, 23],
            '1 days before increase doesnt go past max' => [1, 50, 0, 50],
            '1 days before increase doesnt go past max when quality near max' => [1, 49, 0, 50],
            'quality goes to zero on sale date' => [0, 20, -1, 0],
            'quality goes to zero after sale date' => [-1, 20, -2, 0],
        ]);
    }

    /**
     * @return array
     */
    public function conjuredDataProvider(): array
    {
        return self::addNameToDataSet('Conjured Mana Cake', [
            // sellIn, quality, expectedSellIn, expectedQuality
            'conjured: simple decrease in quality and sellIn' => [6, 23, 5, 21],
            'conjured: quality decreases twice as fast on the sale date' => [0, 20, -1, 16],
            'conjured: quality decreases twice as fast after the sale date' => [-5, 20, -6, 16],
            'conjured: quality cannot go below 0' => [2, 0, 1, 0],
            'conjured: quality cannot go below 0 when it decreases twice as fast' => [0, 1, -1, 0],
        ]);
    }


    /**
     * @dataProvider regularItemDataProvider
     * @dataProvider agedBrieDataProvider
     * @dataProvider sulfurasDataProvider
     * @dataProvider backstagePassesDataProvider
     * @dataProvider conjuredDataProvider
     *
     * @covers GildedRose::updateQuality()
     *
     * @param string $name
     * @param int $sellIn
     * @param int $quality
     * @param int $expectedSellIn
     * @param int $expectedQuality
     * @throws \GildedRose\Exceptions\FactoryClassNotAProductException
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    public function testIfItUpdatesItemCorrectly(
        string $name,
        int $sellIn,
        int $quality,
        int $expectedSellIn,
        int $expectedQuality
    ) {
        $item = new Item($name, $sellIn, $quality);

        (new GildedRose([
            $item,
        ]))->updateQuality();

        $this->assertEquals($expectedQuality, $item->quality);
        $this->assertEquals($expectedSellIn, $item->sell_in);
    }
}
