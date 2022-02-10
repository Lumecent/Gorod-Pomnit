<?php

namespace App\Containers\User\Services;

use App\Containers\User\DTO\ActivateAccountDto;
use Illuminate\Support\Facades\Mail;

class ActivateAccountMessageService
{
    public function run( ActivateAccountDto $dto ): void
    {
        $data = [
            'header' => 'Подтверждение регистрации',
            'text' => 'Для подтверждения регистрации перейдите по ссылке:',
            'link' => "http://127.0.0.1:8885/registration/continue/?token=$dto->token",
        ];

        Mail::send( 'emails', $data, static function ( $message ) use ( $dto ) {
            $message->to( $dto->email, '' )->subject( 'Подтверждение регистрации' );
            $message->from( 'gorod@pomnit.com', 'Город Помнит' );
        } );
    }
}
