<?php

namespace App\Containers\User\Factories;

use App\Containers\User\Services\Auth\RegisterService;

class UserServiceFactory
{
    public static function getRegisterService(): RegisterService
    {
        return app( RegisterService::class );
    }
}