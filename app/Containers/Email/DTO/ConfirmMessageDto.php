<?php

namespace App\Containers\Email\DTO;

use App\Abstractions\DTO\Dto;

class ConfirmMessageDto extends Dto
{
    public int $confirmCode;
    public string $email;
}
