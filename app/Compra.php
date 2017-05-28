<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'user_id', 'precio_unitario', 'cantidad'
    ];

    public function usuario() {
        return $this->belongsTo(User::class);
    }
}
