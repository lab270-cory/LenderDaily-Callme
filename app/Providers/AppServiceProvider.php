<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeComponents();
    }

    /**
     * registers blade components in custom location
     */
    public function registerBladeComponents()
    {
        Blade::component('utils.content-with-loader', 'content-with-loader');
        Blade::component('utils.select2', 'select2');
        Blade::component('utils.timezone-select', 'timezone-select');
    }
}
