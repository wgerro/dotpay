<?php
namespace Gerro\Dotpay\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Dotpay extends Facade {
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'dotpay';
    }
}
