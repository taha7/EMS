<?php

namespace App\Providers;

use App\Repositories\Contracts\InvestorsRepoContract;
use App\Repositories\Eloquent\InvestorsRepo;
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
        app()->bind(InvestorsRepoContract::class, InvestorsRepo::class);
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
