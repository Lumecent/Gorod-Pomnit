<?php

namespace App\Utilities\Facades;

use App\Abstractions\Facades\Facade;
use App\Utilities\Factories\DtoFactory;
use App\Utilities\Factories\RepositoryFactory;
use App\Utilities\Factories\ServiceFactory;

/**
 * @method static DtoFactory getDto
 * @method static RepositoryFactory getRepository
 * @method static ServiceFactory getService
 */
class AppFactory extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'AppFactory';
    }
}