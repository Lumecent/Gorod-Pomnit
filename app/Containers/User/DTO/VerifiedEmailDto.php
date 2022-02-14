<?php

namespace App\Containers\User\DTO;

use App\Abstractions\DTO\Dto;

class VerifiedEmailDto extends Dto
{
    public int $code;
}
