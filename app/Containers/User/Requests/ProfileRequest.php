<?php

namespace App\Containers\User\Requests;

use App\Abstractions\Requests\Request;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Профиль",
 *     description="Обновление профиля пользователя",
 * )
 *
 * @OA\Property(
 *     property="first_name",
 *     type="string",
 *     minLength=2,
 *     maxLength=30,
 *     title="first_name",
 *     description="Имя",
 *     example="Иван",
 * )
 *
 * @OA\Property(
 *     property="last_name",
 *     type="string",
 *     minLength=2,
 *     maxLength=30,
 *     title="last_name",
 *     description="Фамилия",
 *     example="Иванов",
 * )
 *
 * @OA\Property(
 *     property="country",
 *     type="string",
 *     title="country",
 *     minLength=2,
 *     maxLength=30,
 *     description="Страна",
 *     example="Россия",
 * )
 *
 * @OA\Property(
 *     property="city",
 *     type="string",
 *     minLength=2,
 *     maxLength=30,
 *     title="city",
 *     description="Город",
 *     example="Ростов на Дону",
 * )
 *
 * @OA\Property(
 *     property="avatar",
 *     title="avatar",
 *     description="Аватар",
 * )
 */
class ProfileRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [ 'required', 'string', 'min:2', 'max:30', 'regex:/^[a-zа-яё\s-]+$/iu' ],
            'last_name' => [ 'required', 'string', 'min:2', 'max:30', 'regex:/^[a-zа-яё\s-]+$/iu' ],
            'country' => [ 'required', 'string', 'min:2', 'max:30' ],
            'city' => [ 'required', 'string', 'min:2', 'max:30' ],
            'avatar' => [ 'required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:20480' ]
        ];
    }
}
