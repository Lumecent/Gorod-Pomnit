<?php

namespace App\Containers\User\Controllers\Api;

use App\Abstractions\Controllers\ApiController;
use App\Abstractions\Responses\ApiResponse;
use App\Containers\Token\Factories\TokenDtoFactory;
use App\Containers\Token\Factories\TokenServiceFactory;
use App\Containers\User\Factories\UserDtoFactory;
use App\Containers\User\Factories\UserServiceFactory;
use App\Containers\User\Requests\ApiLoginRequest;
use App\Containers\User\Requests\ApiRegisterRequest;
use Illuminate\Support\Facades\DB;
use Throwable;

class AuthController extends ApiController
{
    public function registration( ApiRegisterRequest $request ): ApiResponse
    {
        DB::beginTransaction();

        try {
            $userDto = UserDtoFactory::getRegistrationDto()->fromRequest( $request );
            $user = UserServiceFactory::getRegistrationService()->run( $userDto );

            $tokenDto = TokenDtoFactory::getActivateAccountTokenDto()->fromArray( [
                'user_id' => $user->id,
                'token' => '',
                'action' => ''
            ] );
            $token = TokenServiceFactory::getActivateAccountTokenService()->run( $tokenDto );

            $activateDto = UserDtoFactory::getActivateAccountDto()->fromArray( [
                'email' => $user->email,
                'token' => $token->token
            ] );
            UserServiceFactory::getActivateAccountMessageService()->run( $activateDto );
        } catch ( Throwable ) {
            DB::rollBack();
            return ApiResponse::sendData( 'Произошла ошибка! Повторите попытку позднее', [], 500 );
        }

        DB::commit();

        return ApiResponse::sendData( 'На указанный e-mail было отправлено письмо для подтверждения регистрации' );
    }

    public function login( ApiLoginRequest $request ): ApiResponse
    {
        $dto = UserDtoFactory::getLoginDto()->fromArray( $request->all() );
        $user = UserServiceFactory::getLoginService()->run( $dto );
        if ( $user ) {
            return ApiResponse::sendData( '', [ 'user' => $user ] );
        }

        return ApiResponse::sendData( '', [ 'email' => 'Неправильный e-mail адрес или пароль' ], 422 );
    }
}
