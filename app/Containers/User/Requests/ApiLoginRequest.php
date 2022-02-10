<?php

namespace App\Containers\User\Requests;

use App\Abstractions\Requests\Request;

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
