<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public function usuario() {
        return $this->belongsTo(User::class);
    }
    public function gauchada() {
        return $this->belongsTo(Gauchada::class);
    }
}
