<?php

namespace App\Providers;

use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\Eloquent\AuthorRepository;
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
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
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
