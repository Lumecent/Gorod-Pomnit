<?php

namespace App\Containers\User\Factories;

use App\Containers\User\Services\ActivateAccountMessageService;
use App\Containers\User\Services\Auth\RegistrationService;

class UserServiceFactory
{
    public static function getRegistrationService(): RegistrationService
    {
        return app( RegistrationService::class );
    }

    public static function getActivateAccountMessageService(): ActivateAccountMessageService
    {
        return app( ActivateAccountMessageService::class );
    }
}