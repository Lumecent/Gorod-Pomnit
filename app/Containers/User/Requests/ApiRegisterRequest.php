<?php

namespace App\Containers\User\Requests;

use App\Abstractions\Requests\Request;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Регистрация",
 *     description="Регистрация нового пользователя",
 * )
 *
 * @OA\Property(
 *     property="email",
 *     type="string",
 *     title="email",
 *     description="E-mail адрес",
 *     example="demo@email.com",
 * )
 *
 * @OA\Property(
 *     property="password",
 *     type="string",
 *     title="password",
 *     minLength=6,
 *     maxLength=64,
 *     description="Пароль",
 *     example="password",
 * )
 *
 * @OA\Property(
 *     property="password_confirm",
 *     type="string",
 *     title="password_confirm",
 *     description="Пароль",
 *     example="password",
 * )
 */
class ApiRegisterRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [ 'required', 'string', 'email', 'unique:users,email' ],
            'password' => [ 'required', 'string', 'min:6', 'max:64' ],
            'password_confirm' => [ 'required', 'string', 'same:password' ]
        ];
    }

    public function messages(): array
    {
        return [
            'password_confirm.same' => 'Пароли не совпадают'
        ];
    }
}
