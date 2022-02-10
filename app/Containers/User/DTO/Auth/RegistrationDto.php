<?php

namespace App\Containers\User\DTO\Auth;

use App\Abstractions\DTO\Dto;

class RegistrationDto extends Dto
{
    public string $email;
    public string $password;
}
