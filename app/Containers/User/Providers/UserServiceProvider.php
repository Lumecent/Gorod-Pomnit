<?php

namespace App\Containers\User\Providers;

use App\Base\Providers\AppServiceProvider;
use App\Containers\User\Interfaces\UserRepositoryInterface;
use App\Containers\User\Repositories\UserRepository;

class UserServiceProvider extends AppServiceProvider
{
    public function register(): void
    {
        $this->app->singleton( UserRepositoryInterface::class, fn() => new UserRepository() );
    }
}