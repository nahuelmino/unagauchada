<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class Gauchada extends Model
{
    protected $fillable = [
        'creado_por', 'title', 'description', 'location', 'photo', 'categoria_id','ends_at'
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

    public function postulacions() {
        return $this->hasMany(Postulacion::class,'gauchada');
    }

//    public function getPhotoAttribute($value) {
//        return '/storage/' . $value;
//    }
}
