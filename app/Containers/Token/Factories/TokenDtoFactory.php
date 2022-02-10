<?php

namespace App\Containers\Token\Factories;

use App\Containers\Token\DTO\ActivateAccountTokenDto;

class TokenDtoFactory
{
    public static function getActivateAccountTokenDto(): ActivateAccountTokenDto
    {
        return app( ActivateAccountTokenDto::class );
    }
}