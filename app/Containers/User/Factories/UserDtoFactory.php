<?php

namespace App\Containers\User\Factories;

use App\Containers\User\DTO\ActivateAccountDto;
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

    public static function getActivateAccountDto(): ActivateAccountDto
    {
        return app( ActivateAccountDto::class );
    }
}