<?php

namespace App\Containers\ConfirmCode\Factories;

use App\Containers\ConfirmCode\Services\ConfirmCodeEmailService;

class ConfirmCodeServiceFactory
{
    public static function getConfirmCodeEmailService(): ConfirmCodeEmailService
    {
        return app( ConfirmCodeEmailService::class );
    }
}