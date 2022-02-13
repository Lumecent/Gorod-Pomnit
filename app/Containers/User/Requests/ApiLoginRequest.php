<?php

namespace App\Containers\User\Requests;

use App\Abstractions\Requests\Request;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Авторизация",
 *     description="Авторизация пользователя",
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
 */
class ApiLoginRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [ 'required', 'string', 'email', 'exists:users,email' ],
            'password' => [ 'required', 'string', 'min:6', 'max:64' ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'Неправильный e-mail или пароль'
        ];
    }
}
