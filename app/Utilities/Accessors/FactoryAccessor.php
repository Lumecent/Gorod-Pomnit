<?php

namespace App\Utilities\Accessors;

use App\Utilities\Factories\DtoFactory;
use App\Utilities\Factories\RepositoryFactory;
use App\Utilities\Factories\ServiceFactory;

class FactoryAccessor
{
    public function getService(): ServiceFactory
    {
        return ServiceFactory::create();
    }

    public function getDto(): DtoFactory
    {
        return DtoFactory::create();
    }

    public function getRepository(): RepositoryFactory
    {
        return RepositoryFactory::create();
    }
}