<?php

namespace App\Containers\Token\Factories;

use App\Containers\Token\Services\ActivateAccountTokenService;

class TokenServiceFactory
{
    public static function getActivateAccountTokenService(): ActivateAccountTokenService
    {
        return app( ActivateAccountTokenService::class );
    }
}