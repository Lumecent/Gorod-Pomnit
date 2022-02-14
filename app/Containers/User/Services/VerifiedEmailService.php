<?php

namespace App\Containers\User\Services;

use App\Abstractions\DTO\Dto;
use App\Abstractions\Models\Model;
use App\Containers\ConfirmCode\Interfaces\ConfirmCodeRepositoryInterface;
use App\Containers\User\Interfaces\UserRepositoryInterface;

class VerifiedEmailService
{
    private UserRepositoryInterface $userRepository;
    private ConfirmCodeRepositoryInterface $confirmCodeRepository;

    public function __construct( UserRepositoryInterface $userRepository, ConfirmCodeRepositoryInterface $confirmCodeRepository )
    {
        $this->userRepository = $userRepository;
        $this->confirmCodeRepository = $confirmCodeRepository;
    }

    public function run( Dto $dto ): ?Model
    {
        if ( $this->confirmCodeRepository->delete( $dto->code, $dto->user_id ) ) {
            return $this->userRepository->verifiedEmail( $dto->user_id );
        }
        return null;
    }
}
