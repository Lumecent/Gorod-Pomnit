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
    /**
     * @OA\Post(
     *     path="/auth/registration",
     *     operationId="registration",
     *     tags={"User"},
     *     summary="Регистрация нового пользователя",
     *     @OA\Response(
     *         response="200",
     *         description="Регистрация прошла успешно",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             ),
     *             @OA\Property(
     *                 property="access_token",
     *                 type="string",
     *                 description="Токен активной сессии пользователя",
     *                 example="$42$23RvsdrR3sdf4",
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Сообщение после регистрации",
     *                 example="На указанный e-mail адрес было отправлено письмо для подтверждения",
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Введены некорректные данные",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/ApiRegisterRequest"
     *             ),
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ApiRegisterRequest")
     *     ),
     * )
     *
     * @param ApiRegisterRequest $request
     * @return ApiResponse
     */
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

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     operationId="login",
     *     tags={"User"},
     *     summary="Авторизация пользователя",
     *     @OA\Response(
     *         response="200",
     *         description="Авторизация прошла успешно",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             ),
     *             @OA\Property(
     *                 property="access_token",
     *                 type="string",
     *                 description="Токен активной сессии пользователя",
     *                 example="$42$23RvsdrR3sdf4",
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Введены некорректные данные",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/ApiLoginRequest"
     *             )
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ApiLoginRequest")
     *     ),
     * )
     *
     * @param ApiLoginRequest $request
     * @return ApiResponse
     */
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

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     operationId="logout",
     *     tags={"User"},
     *     summary="Выход из аккаунта",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *        name="Authorization",
     *        in="header",
     *        required=true,
     *        description="Bearer {access-token}",
     *        @OA\Schema(
     *             type="bearerAuth"
     *        )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Выход прошел успешно",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Доступ запрещен",
     *     ),
     * )
     *
     * @param ApiLoginRequest $request
     * @return ApiResponse
     */
    public function logout( Request $request ): ApiResponse
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::sendData( 'Выход из аккаунта выполнен успешно' );
    }
}
