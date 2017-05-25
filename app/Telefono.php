<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    public function usuario() {
        return $this->belongsTo(User::class);
    }
}
