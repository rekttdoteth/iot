<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 'admin';
    const DEFAULT = 'default';

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

    public function isAdmin()    {
        return $this->type === self::ADMIN;
    }

    public function works()
    {
        return $this->hasMany('App\Work', 'user_id');
    }

    public function educations()
    {
        return $this->hasMany('App\Education', 'user_id');
    }

    public function sns()
    {
        return $this->hasMany('App\Sns', 'user_id');
    }

    public function awards()
    {
        return $this->hasMany('App\Award', 'user_id');
    }
}
