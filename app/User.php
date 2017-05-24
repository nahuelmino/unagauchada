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
        'name', 'surname', 'email', 'password', 'date_of_birth', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
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

    public function telefonos() {
        return $this->hasMany(Telefono::class);
    }

    public function aceptaciones() {
        return $this->belongsTo(Gauchada::class);
    }

}
