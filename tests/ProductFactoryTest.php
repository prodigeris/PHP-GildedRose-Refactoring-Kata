<?php

namespace Tests;

use GildedRose\Item;
use GildedRose\ProductFactory;
use GildedRose\ProductFactoryRegistry;
use GildedRose\Products\AgedBrie;
use GildedRose\Products\BackstagePass;
use GildedRose\Products\Conjured;
use GildedRose\Products\RegularProduct;
use GildedRose\Products\Sulfuras;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductFactoryTest
 *
 * @package Tests
 */
class ProductFactoryTest extends TestCase
{
    /**
     * @var ProductFactory
     */
    private $product_factory;

    /**
     * @var ProductFactoryRegistry | \PHPUnit\Framework\MockObject\MockObject
     */
    private $product_factory_registry;

    /**
     *  Set up ProductFactory with registry
     */
    protected function setUp()
    {
        $this->product_factory_registry = $this->getMockBuilder(ProductFactoryRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->product_factory = new ProductFactory($this->product_factory_registry);
    }

    /**
     * @return array
     */
    public function buildableClassDataProvider()
    {
        return [
            'regular product with name' => ['Regular Product', RegularProduct::class],
            'random name' => ['AK-47', RegularProduct::class],
            'random name that is used in the project' => ['+5 Dexterity Vest', RegularProduct::class],
            'Aged Brie' => ['Aged Brie', AgedBrie::class],
            'Sulfuras the legendary weapon' => ['Sulfuras, Hand of Ragnaros', Sulfuras::class],
            'Some good ol tickets' => ['Backstage passes to a TAFKAL80ETC concert', BackstagePass::class],
            'Conjured item' => ['Conjured Mana Cake', Conjured::class],
        ];
    }

    /**
     * @dataProvider buildableClassDataProvider
     * @covers ProductFactory::build
     *
     * @param $itemName
     * @param $expectsClass
     * @throws \GildedRose\Exceptions\FactoryClassNotFoundException
     */
    public function testIfBuildsTheRightClass($itemName, $expectsClass)
    {
        $this->product_factory_registry
            ->expects($this->any())
            ->method('getProducts')
            ->will($this->returnValue([$itemName => $expectsClass]));

        $this->assertInstanceOf($expectsClass, $this->product_factory->build(new Item($itemName, 10, 0)));
    }
}
