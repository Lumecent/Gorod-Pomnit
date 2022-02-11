<?php

namespace App\Containers\User\Factories;

use App\Containers\User\DTO\Auth\LoginDto;
use App\Containers\User\DTO\Auth\RegistrationDto;

class UserDtoFactory
{
    public static function getRegistrationDto(): RegistrationDto
    {
        return app( RegistrationDto::class );
    }

    public static function getLoginDto(): LoginDto
    {
        return app( LoginDto::class );
    }
}