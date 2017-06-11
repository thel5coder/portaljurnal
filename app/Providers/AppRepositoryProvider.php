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
        $this->app->bind('App\\Repositories\\Contracts\\IUserRepository', 'App\\Repositories\\Actions\UserRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IOpenJurnalRepository', 'App\\Repositories\\Actions\OpenJurnalRepository');
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
