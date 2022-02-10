<?php

namespace App\Containers\Token\DTO;

use App\Abstractions\DTO\Dto;

class ActivateAccountTokenDto extends Dto
{
    public int $user_id;
    public string $token;
    public string $action;
}
