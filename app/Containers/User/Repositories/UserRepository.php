<?php

namespace App\Containers\User\Repositories;

use App\Abstractions\DTO\Dto;
use App\Abstractions\Repositories\Repository as BaseRepository;
use App\Containers\User\Interfaces\UserRepositoryInterface;
use App\Containers\User\Models\User as Model;
use App\Abstractions\Models\Model as BaseModel;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected static function getModelClass(): string
    {
        return Model::class;
    }

    public function findByEmail( string $email ): ?BaseModel
    {
        return $this->startConditions()->where( 'email', $email )->first();
    }

    public function create( Dto $dto ): ?BaseModel
    {
        $user = $this->startConditions();

        $user->email = $dto->email;
        $user->password = $dto->password;

        $user->save();

        return $user;
    }

    public function updateById( Dto $dto ): ?BaseModel
    {
        if ( $user = $this->findById( $dto->id ) ) {
            $user->first_name = $dto->first_name;
            $user->last_name = $dto->last_name;
            $user->country = $dto->country;
            $user->city = $dto->city;
            $user->avatar = $dto->avatar;

            $user->save();

            return $user;
        }

        return null;
    }

}
