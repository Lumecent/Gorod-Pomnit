<?php

namespace App\Utilities\Factories;

use App\Abstractions\Factories\CreateObjectFactory;

use App\Containers\User\Repositories\UserRepository;

/**
 * @property UserRepository $user
 */
class RepositoryFactory extends CreateObjectFactory
{
    public function getClassAliases(): array
    {
        return [
            'user' => UserRepository::class,
        ];
    }
}