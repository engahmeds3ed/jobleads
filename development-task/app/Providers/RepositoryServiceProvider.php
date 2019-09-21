<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\CountryRepository::class, \App\Repositories\CountryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StateRepository::class, \App\Repositories\StateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CountyRepository::class, \App\Repositories\CountyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TaxrateRepository::class, \App\Repositories\TaxrateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TaxRepository::class, \App\Repositories\TaxRepositoryEloquent::class);
        //:end-bindings:
    }
}
