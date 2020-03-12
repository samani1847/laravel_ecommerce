<?php
namespace OneStop\Facades;

use Illuminate\Support\Facades\Facade;

class Shoppingcart extends Facade {
    protected static function getFacadeAccessor() { return 'shoppingcart'; }
}
