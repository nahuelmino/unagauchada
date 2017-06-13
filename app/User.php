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
        'name', 'surname', 'email', 'password', 'date_of_birth', 'photo', 'phone'
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

    public function aceptaciones() {
        return $this->hasMany(Gauchada::class);
    }

    public function esAdmin()
    {
        return $this->is_admin === 1;
    }

    public function cant_postulaciones($gauchada_id) {
        $postulaciones = Postulacion::get()->where('gauchada',$gauchada_id)->where('postulante',$this->id)->count();
        return $postulaciones;
    }

    public function cant_necesitados($gauchada_id) {
        $necesitados = Postulacion::get()->where('gauchada',$gauchada_id)->count();
        return $necesitados;
    }
}
