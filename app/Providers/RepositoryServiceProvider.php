<?php

namespace App\Providers;

use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );

        $this->app->bind(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
