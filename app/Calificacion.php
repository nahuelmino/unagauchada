<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{

    protected $fillable = ['name', 'score'];

    public function gauchadas() {
        return $this->hasMany(Gauchada::class);
    }
}
