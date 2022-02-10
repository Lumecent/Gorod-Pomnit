<?php

namespace App\Containers\Token\Repositories;

use App\Abstractions\DTO\Dto;
use App\Abstractions\Repositories\Repository;
use App\Containers\Token\Models\Token as Model;
use App\Abstractions\Models\Model as BaseModel;

class TokenRepository extends Repository
{
    protected static function getModelClass(): string
    {
        return Model::class;
    }

    public function create( Dto $dto ): ?BaseModel
    {
        $token = $this->startConditions();

        $token->user_id = $dto->user_id;
        $token->token = $dto->token;
        $token->action = $dto->action;

        $token->save();

        return $token;
    }
}
