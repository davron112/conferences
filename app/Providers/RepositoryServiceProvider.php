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
        $this->app->bind(\App\Repositories\Contracts\ConferenceRepository::class, \App\Repositories\ConferenceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\RequestRepository::class, \App\Repositories\RequestRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\UserFileRepository::class, \App\Repositories\UserFileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PaymentRepository::class, \App\Repositories\PaymentRepositoryEloquent::class);
        //:end-bindings:
    }
}
