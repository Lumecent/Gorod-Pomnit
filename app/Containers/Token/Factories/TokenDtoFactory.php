<?php

namespace App\Containers\Token\Factories;

use App\Containers\Token\DTO\RegistrationTokenDto;

class TokenDtoFactory
{
    public static function getActivateAccountTokenDto(): RegistrationTokenDto
    {
        return app( RegistrationTokenDto::class );
    }
}