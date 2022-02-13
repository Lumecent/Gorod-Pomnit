<?php

namespace App\Containers\User\Interfaces;

use App\Abstractions\Models\Model;

interface UserRepositoryInterface
{
    public function findByEmail( string $email ): ?Model;
}