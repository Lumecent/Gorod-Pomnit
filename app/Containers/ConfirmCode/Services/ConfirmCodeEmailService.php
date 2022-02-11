<?php

namespace App\Containers\ConfirmCode\Services;

use App\Abstractions\DTO\Dto;
use App\Abstractions\Models\Model;
use App\Containers\ConfirmCode\Repositories\ConfirmCodeRepository;

class ConfirmCodeEmailService
{
    private ConfirmCodeRepository $confirmCodeRepository;

    public function __construct( ConfirmCodeRepository $confirmCodeRepository )
    {
        $this->confirmCodeRepository = $confirmCodeRepository;
    }

    public function run( Dto $dto ): Model
    {
        $dto->code = random_int( 100000, 999999 );
        $dto->action = 'confirm_email';

        return $this->confirmCodeRepository->create( $dto );
    }
}
