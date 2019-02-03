### Requirements

**php**: 7.1 or above

### Installation

`composer require prodigeris/php-gilded-rose-refactoring-kata`

### Usage

```php
<?php

$sulfuras = new \GildedRose\Item('Sulfuras, Hand of Ragnaros', 80, 2);
$regularItem = new \GildedRose\Item('AK-47, Hand of Ragnaros', 10, 2);
$backstagePass = new \GildedRose\Item('Backstage passes to a TAFKAL80ETC concert', 10, 2);

$items = compact('sulfuras', 'regularItem', 'backstagePass');

$gildedRose = new \GildedRose\GildedRose($items);
$gildedRose->updateQuality();
```

### Tests

Just run `phpunit` to execute all the tests.

### Description

This is my PHP solution to [Gilded Rose Refactoring Kata](https://github.com/emilybache/GildedRose-Refactoring-Kata) by [Terry Hughes](https://twitter.com/TerryHughes).

It was quite a fun; I have managed to use a couple of design patterns.

- **Abstract Factory Pattern** to build `Products` (implementations of `Items`)
- **Decorator Pattern** for `Products` to modify `Item` values.
- **Command Pattern** to modify `Item` values according to rules.

### Product

Everything about the `Product` can be set dynamically.
- Traits
  - `HasDayRangeMultiplier`. If the quality of the product changes differently over time.
  **Used by default.**
  - `Expires`. If the quality of the product goes to zero after the sale date. (e.g. `BackstagePass`)
- Properties
  - const `name`. The name by which `ProductFactory` identifies the `Product`. **Default:** `empty`
  - `max_quality`. Determines max value of the quality. **Default:** `50`
  - `min_quality`. Determines min value of the quality. **Default:** `0`
  - `quality_step`. Determines the direction and speed of quality change over time. **Default:** `-1`
  - `day_range_multiplier`. Determines how quality acts depending on the days.
   **Default:** `[0 => 2]` which means that after the sale date the quality step is twice as large.
- Public methods   
  - `update`. Updates `Item` for the new day.
  - `getItem`. Returns `Item` assigned to the product.
  - `getMaxQuality`
  - `getMinQuality`
  - `getQualityStep`. Returns the quality step taking multipliers in mind.
  - `getNewQuality`. Returns the quality for the next day.
 *Warning: It does not take rules in mind. Rules are checked on property change.*
  - `isAfterSale`. Returns if the product has passed the sale date

### New Product
If you want to introduce a new product, first create a class in `Products` directory.

E.g.

```php
<?php

namespace GildedRose\Products;

use GildedRose\Product;

/**
 * Class Conjured
 *
 * @package \GildedRose\Products
 */
class Conjured extends Product
{
    /**
     * The name of the product
     */
    const NAME = 'Conjured Mana Cake';

    /**
     * Quality increases by 2 over time
     *
     * @var int
     */
    protected static $quality_step = -2;
}
```

Then register the class in the constructor of `ProductFactory`.

```php
public function __construct()
{
    $this->register(BackstagePass::class);
    $this->register(Sulfuras::class);
    $this->register(AgedBrie::class);
    $this->register(RegularProduct::class);
    // new class
    $this->register(Conjured::class);
}
```
Voilà!


