<?php

namespace App\Containers\Token\Models;

use App\Abstractions\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $action
 */
class Token extends Model
{
    use HasFactory;

    protected $table = 'register_tokens';
}
