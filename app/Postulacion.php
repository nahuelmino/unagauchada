<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $fillable = [
        'postulante', 'necesitado', 'gauchada'
    ];

    public function postulante() {
        return $this->belongsTo(User::class);
    }

    public function necesitado() {
        return $this->belongsTo(User::class);
    }
}
