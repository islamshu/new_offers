<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Session;

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
        $lang = Session::get('lang');
        if($lang == null){
            $lang = 'en';
        }   
        $this->app['request']->server->set('HTTPS', true);

        $this->app->setLocale($lang);

        Paginator::useBootstrap();

        Schema::defaultStringLength(191);

    }
}
