<?php

namespace OneStop\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Lib\ClientInterface', 
        'App\Lib\GuzzleClient');
        
        $this->app->bind('rest', function(){
            return new \OneStop\CustomClass\Rest;
        });
        $this->app->bind('shoppingcart', function(){
            return new \OneStop\CustomClass\Shoppingcart;
        });
    }
}
