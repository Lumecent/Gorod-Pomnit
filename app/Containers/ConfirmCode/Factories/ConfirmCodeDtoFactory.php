<?php

namespace App\Containers\ConfirmCode\Factories;


use App\Containers\ConfirmCode\DTO\ConfirmCodeEmailDto;

class ConfirmCodeDtoFactory
{
    public static function getConfirmEmailCodeDto(): ConfirmCodeEmailDto
    {
        return app( ConfirmCodeEmailDto::class );
    }
}