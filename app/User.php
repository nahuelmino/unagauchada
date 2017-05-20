<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'contraseña', 'remember_token',
    ];


    public function publicaciones() {
        return $this->hasMany(Gauchada::class);
    }

    public function postulaciones() {
        return $this->hasMany(Gauchada::class);
    }

    public function compras() {
        return $this->hasMany(Compra::class);
    }

}
