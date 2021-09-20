<?php

namespace App\Models;

use App\Models\Traits\ModelBasically;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property string $name
 */
class User extends Authenticatable
{
    use Notifiable, ModelBasically;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function hashPassword($password)
    {
        return bcrypt($password);
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = self::hashPassword($value);
    }

    public function getName()
    {
        return $this->name;
    }

    public function isAdmin()
    {
        return true;
    }

    public function canEditOrDestroyOtherUser($ids)
    {
        $ids = (is_array($ids) ? $ids : [(int)$ids]);

        return $this->isAdmin() || !array_diff([$this->getKey()], $ids);
    }
}
