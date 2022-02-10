<?php

namespace App\Containers\User\Services\Auth;

use App\Abstractions\Models\Model;
use App\Containers\User\DTO\Auth\RegistrationDto;
use App\Containers\User\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    private UserRepositoryInterface $userRepository;

    public function __construct( UserRepositoryInterface $userRepository )
    {
        $this->userRepository = $userRepository;
    }

    public function run( RegistrationDto $dto ): Model
    {
        $dto->password = Hash::make( $dto->password );

        return $this->userRepository->create( $dto );
    }
}
