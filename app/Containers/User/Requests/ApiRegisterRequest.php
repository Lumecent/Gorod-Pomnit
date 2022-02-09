<?php

namespace App\Containers\User\Requests;

use App\Abstractions\Requests\Request;

class ApiRegisterRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|max:64',
            'password_confirm' => 'required|string|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'password_confirm.same' => 'Пароли не совпадают'
        ];
    }
}
