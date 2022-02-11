<?php

namespace App\Containers\Email\Services;

use App\Abstractions\DTO\Dto;
use Illuminate\Support\Facades\Mail;

class ConfirmMessageService
{
    public function run( Dto $dto ): void
    {
        $data = [
            'header' => 'Подтверждение e-mail адреса',
            'text' => 'Для подтверждения e-mail адреса введите код в приложении:',
            'code' => $dto->confirmCode,
        ];

        Mail::send( 'emails', $data, static function ( $message ) use ( $dto ) {
            $message->to( $dto->email, '' )->subject( 'Подтверждение e-mail адреса' );
            $message->from( 'gorod@pomnit.com', 'Город Помнит' );
        } );
    }
}
