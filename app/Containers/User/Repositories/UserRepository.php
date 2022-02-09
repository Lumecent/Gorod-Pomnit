<?php

namespace App\Containers\User\Repositories;

use App\Abstractions\Repositories\Repository as BaseRepository;
use App\Containers\User\Interfaces\UserRepositoryInterface;
use App\Containers\User\Models\User as Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected static function getModelClass(): string
    {
        return Model::class;
    }
}
