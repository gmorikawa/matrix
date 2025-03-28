<?php

namespace App\Providers;

use App\Services\RepositoryService;
use App\Services\RepositoryServiceImpl;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(RepositoryService::class, RepositoryServiceImpl::class);
    }
}
