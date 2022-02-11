<?php

namespace App\Containers\Email\Factories;

use App\Containers\Email\Services\ConfirmMessageService;

class EmailServiceFactory
{
    public static function getConfirmMessageService(): ConfirmMessageService
    {
        return app( ConfirmMessageService::class );
    }
}