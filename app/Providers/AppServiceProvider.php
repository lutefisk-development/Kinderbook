<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
            since laravel uses the "utf8mb4" character set by default, (specified in /config/database.php) which is 4 bytes and the max key length is 767
            we need to change the string length to 191.

            before change: 4 * 255 = 1020 which is more then 767, will result in sql error.
            after change: 4 * 191 = 764 which is less then 767
        */
        Schema::defaultStringLength(191);

        /*
            This removes the data attribute when using the api.
        */
        //Resource::withoutWrapping();
    }
}
