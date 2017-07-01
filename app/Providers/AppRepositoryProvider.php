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
        $this->app->bind('App\\Repositories\\Contracts\\IKategoriRepository', 'App\\Repositories\\Actions\KategoriRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IJurnalRepository', 'App\\Repositories\\Actions\JurnalRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IPenulisJurnalRepository', 'App\\Repositories\\Actions\PenulisJurnalRepository');
        $this->app->bind('App\\Repositories\\Contracts\\IBlindReviewRepository', 'App\\Repositories\\Actions\BlindReviewRepository');
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
