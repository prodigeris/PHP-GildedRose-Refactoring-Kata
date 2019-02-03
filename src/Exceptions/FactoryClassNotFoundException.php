<?php

namespace GildedRose\Exceptions;

/**
 * Class FactoryClassNotFoundException
 *
 * @package \GildedRose\Exceptions
 */
class FactoryClassNotFoundException extends \Exception
{
    protected $message = 'Factory class not found';
}