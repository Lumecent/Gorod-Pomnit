<?php

namespace App\Containers\User\Services\Auth;

use App\Abstractions\DTO\Dto;
use App\Abstractions\Models\Model;
use App\Containers\User\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    private UserRepositoryInterface $userRepository;

    public function __construct( UserRepositoryInterface $userRepository )
    {
        $this->userRepository = $userRepository;
    }

    public function run( Dto $dto ): ?Model
    {
        $user = $this->userRepository->findByEmail( $dto->email );

        return Hash::check( $dto->password, $user?->password ) ? $user : null;
    }
}
