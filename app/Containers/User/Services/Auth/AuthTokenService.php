<?php

namespace App\Containers\User\Services\Auth;

use App\Abstractions\Models\Model;

class AuthTokenService
{
    public function run( Model $userModel ): string
    {
        return $userModel->createToken( $userModel->email )->plainTextToken;
    }
}
