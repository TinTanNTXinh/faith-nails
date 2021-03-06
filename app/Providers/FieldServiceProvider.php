<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
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
            'App\Repositories\FieldRepositoryInterface',
            'App\Repositories\Eloquent\FieldEloquentRepository'
        );

        /*
         * =============== SERVICE ===============
         * */
        $this->app->bind(
            'App\Services\FieldServiceInterface',
            'App\Services\Implement\FieldService'
        );
    }
}
