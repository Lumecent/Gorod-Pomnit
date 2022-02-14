<?php

namespace App\Containers\User\Factories;

use App\Containers\User\Services\Auth\AuthTokenService;
use App\Containers\User\Services\Auth\LoginService;
use App\Containers\User\Services\Auth\RegistrationService;
use App\Containers\User\Services\VerifiedEmailService;

class UserServiceFactory
{
    public static function getRegistrationService(): RegistrationService
    {
        return app( RegistrationService::class );
    }

    public static function getLoginService(): LoginService
    {
        return app( LoginService::class );
    }

    public static function getAuthTokenService(): AuthTokenService
    {
        return app( AuthTokenService::class );
    }

    public static function getVerifiedEmailService(): VerifiedEmailService
    {
        return app( VerifiedEmailService::class );
    }
}