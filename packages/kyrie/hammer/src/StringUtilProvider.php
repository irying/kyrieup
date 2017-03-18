<?php

namespace Kyrie\Hammer;

use Illuminate\Support\ServiceProvider;

class StringUtilProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('stringUtil', function (){
            return new StringUtil();
        });
    }
}
