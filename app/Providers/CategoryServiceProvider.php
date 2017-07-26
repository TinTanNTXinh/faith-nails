<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
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
            'App\Repositories\CategoryRepositoryInterface',
            'App\Repositories\Eloquent\CategoryEloquentRepository'
        );

        /*
         * =============== SERVICE ===============
         * */
        $this->app->bind(
            'App\Services\CategoryServiceInterface',
            'App\Services\Implement\CategoryService'
        );
    }
}
