<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gauchada extends Model
{
    protected $fillable = [
        'creado_por', 'title', 'description', 'location', 'categoria','ends_at'
    ];

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
