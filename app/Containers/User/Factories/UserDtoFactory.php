<?php

namespace App\Containers\User\Factories;

use App\Containers\User\DTO\Auth\LoginDto;
use App\Containers\User\DTO\Auth\RegistrationDto;
use App\Containers\User\DTO\LoadAvatarUserDto;
use App\Containers\User\DTO\ProfileDto;
use App\Containers\User\DTO\VerifiedEmailDto;

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

    public static function getProfileDto(): ProfileDto
    {
        return app( ProfileDto::class );
    }

    public static function getVerifiedEmailDto(): VerifiedEmailDto
    {
        return app( VerifiedEmailDto::class );
    }

    public static function getLoadAvatarUserDto(): LoadAvatarUserDto
    {
        return app( LoadAvatarUserDto::class );
    }
}