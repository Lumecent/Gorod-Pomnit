<?php

namespace App\Containers\Token\Services;

use App\Abstractions\Models\Model;
use App\Containers\Token\DTO\ActivateAccountTokenDto;
use App\Containers\Token\Repositories\TokenRepository;
use Illuminate\Support\Facades\Hash;

class ActivateAccountTokenService
{
    protected TokenRepository $tokenRepository;

    public function __construct( TokenRepository $tokenRepository )
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function run( ActivateAccountTokenDto $dto ): Model
    {
        $dto->token = Hash::make( $dto->user_id . time() );
        $dto->action = 'registration';

        return $this->tokenRepository->create( $dto );
    }
}
