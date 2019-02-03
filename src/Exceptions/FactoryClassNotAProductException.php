<?php

namespace GildedRose\Exceptions;

/**
 * Class FactoryClassNotFoundException
 *
 * @package \GildedRose\Exceptions
 */
class FactoryClassNotAProductException extends \Exception
{
    protected $message = 'Factory class is not a product';
}