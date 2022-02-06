<?php

namespace App\Utilities\Factories;

use App\Abstractions\Factories\CreateObjectFactory;

use App\Containers\User\Factories\UserDtoFactory;

/**
 * @property UserDtoFactory $user
 */
class DtoFactory extends CreateObjectFactory
{
    public function getClassAliases(): array
    {
        return [
            'user' => UserDtoFactory::class
        ];
    }
}