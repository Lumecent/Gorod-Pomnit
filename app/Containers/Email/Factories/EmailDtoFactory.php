<?php

namespace App\Containers\Email\Factories;

use App\Containers\Email\DTO\ConfirmMessageDto;

class EmailDtoFactory
{
    public static function getConfirmMessageDto(): ConfirmMessageDto
    {
        return app( ConfirmMessageDto::class );
    }
}