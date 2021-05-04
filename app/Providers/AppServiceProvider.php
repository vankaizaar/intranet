<?php

namespace App\Providers;

use App\Document;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
    
        $dashboard->registerResource('stylesheets', '/css/myapp.css');              
        $dashboard->registerResource('scripts','/js/dashboard.js');         
        $dashboard->registerGlobalSearch([
            Document::class,
        ]);

    }
}
