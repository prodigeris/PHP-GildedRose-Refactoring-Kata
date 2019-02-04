<?php

namespace Tests;

use GildedRose\Commands\SellInUpdateCommand;
use GildedRose\Item;
use GildedRose\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeQualityCommandTest
 *
 * @package Tests
 */
class SellInUpdateCommandTest extends TestCase
{
    /**
     * @var \GildedRose\Commands\SellInUpdateCommand
     */
    private $sell_in_update_command;

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
    protected function buildItem($sellIn): void
    {
        $this->item = new Item('Any Item', $sellIn, 40);

        $this->product = $this->getMockBuilder(Product::class)->disableOriginalConstructor()->getMock();

        $this->product->expects($this->any())->method('getItem')->will($this->returnValue($this->item));

        $this->sell_in_update_command = new SellInUpdateCommand($this->product);
    }

    /**
     * Test various values of qualities
     *
     * @return array
     */
    public function sellInDataProvider(): array
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
     * @dataProvider sellInDataProvider
     *
     * @covers       SellInUpdateCommand::execute()
     *
     * @param int $sellIn
     */
    public function testIfDecreasesSellIn(int $sellIn)
    {
        $this->buildItem($sellIn);

        $this->sell_in_update_command->execute();
        $this->assertEquals($sellIn - 1, $this->item->sell_in);

        $this->sell_in_update_command->execute();
        $this->assertEquals($sellIn - 2, $this->item->sell_in);
    }
}