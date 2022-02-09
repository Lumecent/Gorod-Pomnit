<?php

namespace App\Containers\User\Factories;

use App\Containers\User\DTO\Auth\RegisterDto;

class UserDtoFactory
{
    public static function getRegisterDto(): RegisterDto
    {
        return app( RegisterDto::class );
    }
}