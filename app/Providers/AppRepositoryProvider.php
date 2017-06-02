<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\\Repository\\Contract\\IUserRepository', 'App\\Repository\\Action\UserRepository');
        $this->app->bind('App\\Repository\\Contract\\IPelangganRepository', 'App\\Repository\\Action\PelangganRepository');
        $this->app->bind('App\\Repository\\Contract\\IPemasanganRepository', 'App\\Repository\\Action\PemasanganRepository');
        $this->app->bind('App\\Repository\\Contract\\IRefillRepository', 'App\\Repository\\Action\RefillRepository');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
