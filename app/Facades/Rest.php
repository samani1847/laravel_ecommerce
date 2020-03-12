<?php
namespace OneStop\Facades;

use Illuminate\Support\Facades\Facade;

class Rest extends Facade {
    protected static function getFacadeAccessor() { return 'rest'; }
}
