<?php

namespace App\Containers\ConfirmCode\Repositories;

use App\Abstractions\DTO\Dto;
use App\Abstractions\Repositories\Repository;
use App\Abstractions\Models\Model as BaseModel;
use App\Containers\ConfirmCode\Models\ConfirmCode as Model;

class ConfirmCodeRepository extends Repository
{
    protected static function getModelClass(): string
    {
        return Model::class;
    }

    public function create( Dto $dto ): BaseModel
    {
        $code = $this->startConditions();

        $code->user_id = $dto->user_id;
        $code->code = $dto->code;
        $code->action = $dto->action;

        $code->save();

        return $code;
    }
}
