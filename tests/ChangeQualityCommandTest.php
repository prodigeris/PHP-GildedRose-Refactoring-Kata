<?php

namespace Tests;

use GildedRose\Commands\ChangeQualityCommand;
use GildedRose\Item;
use GildedRose\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeQualityCommandTest
 *
 * @package Tests
 */
class ChangeQualityCommandTest extends TestCase
{
    /**
     * @var ChangeQualityCommand
     */
    private $change_quality_command;

    /**
     * @var Product | \PHPUnit\Framework\MockObject\MockObject
     */
    private $product;

    /**
     * @var Item
     */
    private $item;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->item = new Item('Any Item', 5, 40);

        $this->product = $this->getMockBuilder(Product::class)->disableOriginalConstructor()->getMock();

        $this->product->expects($this->any())->method('getItem')->will($this->returnValue($this->item));

        $this->change_quality_command = new ChangeQualityCommand($this->product);
    }

    /**
     * Test various values of qualities
     *
     * @return array
     */
    public function qualityDataProvider(): array
    {
        return [
            [-10],
            [-5,],
            [0,],
            [6,],
            [20,],
            [35,],
            [50,],
            [80,],
        ];
    }

    /**
     * @dataProvider qualityDataProvider
     *
     * @covers       ChangeQualityCommand::setQuality()
     * @covers       ChangeQualityCommand::execute()
     *
     * @param int $quality
     */
    public function testIfChangesQualityCorrectly(int $quality)
    {
        $this->change_quality_command->setQuality($quality)->execute();

        $this->assertEquals($quality, $this->item->quality);
    }
}