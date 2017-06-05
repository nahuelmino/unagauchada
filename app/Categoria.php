<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function gauchadas() {
        return $this->hasMany(Gauchada::class);
    }
}
