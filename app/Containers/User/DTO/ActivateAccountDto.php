<?php

namespace App\Containers\User\DTO;

use App\Abstractions\DTO\Dto;

class ActivateAccountDto extends Dto
{
    public string $email;
    public string $token;
}
