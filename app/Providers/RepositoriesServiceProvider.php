<?php

namespace App\Providers;

use App\Repositories\Contracts\ClientRepoContract;
use App\Repositories\Eloquent\ClientRepo\ClientRepo;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(ClientRepoContract::class, ClientRepo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
