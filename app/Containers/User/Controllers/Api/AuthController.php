<?php

namespace App\Containers\User\Controllers\Api;

use App\Abstractions\Controllers\ApiController;
use App\Abstractions\Requests\Request;
use App\Abstractions\Responses\ApiResponse;
use App\Containers\ConfirmCode\Factories\ConfirmCodeDtoFactory;
use App\Containers\ConfirmCode\Factories\ConfirmCodeServiceFactory;
use App\Containers\Email\Factories\EmailDtoFactory;
use App\Containers\Email\Factories\EmailServiceFactory;
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

            $confirmCodeDto = ConfirmCodeDtoFactory::getConfirmEmailCodeDto()->fromArray( [
                'code' => 0,
                'action' => '',
                'user_id' => $user->id
            ] );
            $code = ConfirmCodeServiceFactory::getConfirmCodeEmailService()->run( $confirmCodeDto );

            $confirmMessageDto = EmailDtoFactory::getConfirmMessageDto()->fromArray( [
                'confirmCode' => $code->code,
                'email' => $user->email
            ] );
            EmailServiceFactory::getConfirmMessageService()->run( $confirmMessageDto );

            $accessToken = UserServiceFactory::getAuthTokenService()->run( $user );
        } catch ( Throwable $exception ) {
            DB::rollBack();
            return ApiResponse::sendData( 'Произошла ошибка! Повторите попытку позднее', [ $exception->getMessage() ], 500 );
        }

        DB::commit();

        return ApiResponse::sendData(
            'На указанный e-mail адрес было отправлено письмо для подтверждения',
            [ 'user' => $user, 'access_token' => $accessToken ]
        );
    }

    public function login( ApiLoginRequest $request ): ApiResponse
    {
        $dto = UserDtoFactory::getLoginDto()->fromArray( $request->all() );
        $user = UserServiceFactory::getLoginService()->run( $dto );
        if ( $user ) {
            $accessToken = UserServiceFactory::getAuthTokenService()->run( $user );
            return ApiResponse::sendData( '', [ 'user' => $user, 'access_token' => $accessToken ] );
        }

        return ApiResponse::sendData( '', [ 'email' => 'Неправильный e-mail адрес или пароль' ], 422 );
    }

    public function logout( Request $request ): ApiResponse
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::sendData( 'Выход из аккаунта выполнен успешно' );
    }
}
