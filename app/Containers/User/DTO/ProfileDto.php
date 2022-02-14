<?php

namespace App\Containers\User\DTO;

use App\Abstractions\DTO\Dto;

class ProfileDto extends Dto
{
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $country;
    public string $city;
    public string $avatar;
}
