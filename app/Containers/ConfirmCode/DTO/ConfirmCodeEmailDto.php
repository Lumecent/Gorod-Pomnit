<?php

namespace App\Containers\ConfirmCode\DTO;

use App\Abstractions\DTO\Dto;

class ConfirmCodeEmailDto extends Dto
{
    public int $code;
    public int $user_id;
    public string $action;
}
