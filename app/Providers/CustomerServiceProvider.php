<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
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
        /*
         * =============== REPOSITORY ===============
         * */
        $this->app->bind(
            'App\Repositories\CustomerRepositoryInterface',
            'App\Repositories\Eloquent\CustomerEloquentRepository'
        );

        /*
         * =============== SERVICE ===============
         * */
        $this->app->bind(
            'App\Services\CustomerServiceInterface',
            'App\Services\Implement\CustomerService'
        );
    }
}
