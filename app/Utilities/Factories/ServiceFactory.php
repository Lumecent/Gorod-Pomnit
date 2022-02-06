<?php

namespace App\Utilities\Factories;

use App\Abstractions\Factories\CreateObjectFactory;

use App\Containers\User\Factories\UserServiceFactory;

/**
 * @property UserServiceFactory $user
 */
class ServiceFactory extends CreateObjectFactory
{
    public function getClassAliases(): array
    {
        return [
            'user' => UserServiceFactory::class,
        ];
    }
}