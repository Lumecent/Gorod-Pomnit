<?php

namespace App\Containers\User\Models;

use App\Abstractions\Models\Auth;
use App\Containers\User\Data\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Информация о пользователе",
 *     description="Информация о пользователе",
 * )
 *
 * @OA\Property(
 *     property="id",
 *     type="int",
 *     title="id",
 *     description="Идентификатор",
 *     example=1,
 * )
 *
 * @OA\Property(
 *     property="first_name",
 *     type="string",
 *     title="first_name",
 *     description="Имя",
 *     example="Иван",
 * )
 *
 * @OA\Property(
 *     property="last_name",
 *     type="string",
 *     title="last_name",
 *     description="Фамилия",
 *     example="Иванов",
 * )
 *
 * @OA\Property(
 *     property="country",
 *     type="string",
 *     title="country",
 *     description="Страна",
 *     example="Россия",
 * )
 *
 * @OA\Property(
 *     property="city",
 *     type="string",
 *     title="city",
 *     description="Город",
 *     example="Ростов на Дону",
 * )
 *
 * @OA\Property(
 *     property="email",
 *     type="string",
 *     title="email",
 *     description="E-mail адрес",
 *     example="demo@email.com",
 * )
 *
 * @OA\Property(
 *     property="avatar",
 *     type="string",
 *     title="avatar",
 *     description="Аватар",
 *     example="images/users/1/avatar.jpeg",
 * )
 *
 * @OA\Property(
 *     property="count_photos",
 *     type="int",
 *     title="count_photos",
 *     description="Количество загруженных фотографий",
 *     example=10,
 * )
 *
 * @OA\Property(
 *     property="count_reports",
 *     type="int",
 *     title="count_reports",
 *     description="Количество жалоб на пользователя",
 *     example=10,
 * )
 *
 * @OA\Property(
 *     property="count_likes",
 *     type="int",
 *     title="count_likes",
 *     description="Количество лайков на фотографиях пользователя",
 *     example=10,
 * )
 *
 * @OA\Property(
 *     property="verified",
 *     type="int",
 *     title="verified",
 *     description="Подтвержен ли e-mail",
 *     example=1,
 * )
 *
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
