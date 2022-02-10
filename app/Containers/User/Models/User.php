<?php

namespace App\Containers\User\Models;

use App\Abstractions\Models\Auth;
use App\Containers\User\Data\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $country
 * @property string $city
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property int $count_photos
 * @property int $count_reports
 * @property int $count_likes
 * @property int $verified
 */
class User extends Auth
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'city',
        'email',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password'
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
