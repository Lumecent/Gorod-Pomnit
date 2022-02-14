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
 *     property="code",
 *     title="code",
 *     description="Код подтверждения",
 *     type="integer",
 *     example=345768
 * )
 */
class VerifiedEmailRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => [ 'required', 'integer', 'exists:confirm_codes.code' ]
        ];
    }
}
