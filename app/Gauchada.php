<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gauchada extends Model
{
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function publicado() {
        return $this->belongsTo(User::class);
    }

    public function aceptado() {
        return $this->belongsTo(User::class);
    }
}
