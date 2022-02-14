<?php

namespace App\Containers\User\Controllers\Api;

use App\Abstractions\Controllers\ApiController;
use App\Abstractions\Responses\ApiResponse;
use App\Containers\User\Factories\UserDtoFactory;
use App\Containers\User\Factories\UserServiceFactory;
use App\Containers\User\Interfaces\UserRepositoryInterface;
use App\Containers\User\Requests\ProfileRequest;
use App\Containers\User\Requests\VerifiedEmailRequest;

class UserController extends ApiController
{
    private UserRepositoryInterface $repository;

    public function __construct( UserRepositoryInterface $userRepository )
    {
        $this->repository = $userRepository;
    }

    /**
     * @OA\Get(
     *     path="/user/{id}",
     *     operationId="getUser",
     *     tags={"User"},
     *     summary="Получение информации о пользователе",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор пользователя",
     *         required=true,
     *         example=1,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             )
     *         )
     *     )
     * )
     *
     * @param int $id
     * @return ApiResponse
     */
    public function show( int $id ): ApiResponse
    {
        $user = $this->repository->findById( $id );

        return ApiResponse::sendData( '', [ 'user' => $user ] );
    }

    /**
     * @OA\Post(
     *     path="/user/{id}/profile",
     *     operationId="updateProfile",
     *     tags={"User"},
     *     summary="Обновление профиля",
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
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор пользователя",
     *         required=true,
     *         example=1,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProfileRequest")
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Доступ запрещен",
     *     ),
     * )
     *
     * @param ProfileRequest $request
     * @param int $id
     * @return ApiResponse
     */
    public function update( ProfileRequest $request, int $id ): ApiResponse
    {
        $profileDto = UserDtoFactory::getProfileDto()->fromArray( array_merge( [ 'id' => $id ], $request->all() ) );
        $user = $this->repository->update( $profileDto );
    }

    /**
     * @OA\Post(
     *     path="/user/{id}/verify",
     *     operationId="verifyEmail",
     *     tags={"User"},
     *     summary="Подтверждение e-mail адреса",
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
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор пользователя",
     *         required=true,
     *         example=1,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/VerifiedEmailRequest")
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="422",
     *         description="Введены некорректные данные",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/VerifiedEmailRequest"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="401",
     *         description="Доступ запрещен",
     *     ),
     * )
     *
     * @param VerifiedEmailRequest $request
     * @param int $id
     * @return ApiResponse
     */
    public function verifiedEmail( VerifiedEmailRequest $request, int $id ): ApiResponse
    {
        $verifiedEmailDto = UserDtoFactory::getVerifiedEmailDto()->fromArray( [
            'code' => $request->get( 'code' ),
            'user_id' => $id
        ] );
        $user = UserServiceFactory::getVerifiedEmailService()->run( $verifiedEmailDto );
        if ( $user ) {
            return ApiResponse::sendData( '', [ 'user' => $user ] );
        }

        return ApiResponse::sendData( '', [ 'code' => 'Код подтверждения не существует' ], 422 );
    }
}
