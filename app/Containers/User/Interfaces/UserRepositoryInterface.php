<?php

namespace App\Containers\User\Interfaces;

use App\Abstractions\Models\Model;

interface UserRepositoryInterface
{
    public function findById( int $userId ): ?Model;

    public function findByEmail( string $email ): ?Model;
}