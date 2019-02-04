<?php

namespace Tests;

use GildedRose\Products\AgedBrie;
use GildedRose\Products\BackstagePass;
use GildedRose\Products\Conjured;
use GildedRose\Products\RegularProduct;
use GildedRose\Products\Sulfuras;
use PHPUnit\Framework\TestCase;

use GildedRose\ProductFactoryRegistry;

/**
 * Class ProductFactoryRegistryTest
 *
 * @package Tests
 */
class ProductFactoryRegistryTest extends TestCase
{
    /**
     * @var ProductFactoryRegistry
     */
    private $product_factory_registry;

    /**
     *
     */
    protected function setUp()
    {
        $this->product_factory_registry = new ProductFactoryRegistry();
    }

    public function classDataProvider()
    {
        return [
            [
                RegularProduct::NAME,
                RegularProduct::class,
            ],
            [
                AgedBrie::NAME,
                AgedBrie::class,
            ],
            [
                Sulfuras::NAME,
                Sulfuras::class,
            ],
            [
                BackstagePass::NAME,
                BackstagePass::class,
            ],
            [
                Conjured::NAME,
                Conjured::class,
            ],
        ];
    }

    /**
     * @dataProvider classDataProvider
     * @covers       ProductFactoryRegistry::register
     */

    public function testIfRegistersAClass(string $name, string $class)
    {
        $this->product_factory_registry->register($class);

        $products = $this->product_factory_registry->getProducts();

        $this->assertArraySubset([$name => $class], $products);
    }
    /**
     * @covers       ProductFactoryRegistry::register
     * @expectedException  \GildedRose\Exceptions\FactoryClassNotAProductException
     */

    public function testIfDoesntLetToRegisterNotAProduct()
    {
        $this->product_factory_registry->register(\stdClass::class);
    }
}