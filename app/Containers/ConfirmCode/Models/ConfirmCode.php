<?php

namespace App\Containers\ConfirmCode\Models;

use App\Abstractions\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $user_id
 * @property int $code
 * @property string $action
 */
class ConfirmCode extends Model
{
    use HasFactory;

    protected $table = 'confirm_codes';
}
