<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    protected $fillable = [
        'nombre', 'valor'
    ];
}

/*
select r.nombre
from rangos r
where r.valor <= (select u.score
		from users u
		where u.name="Admin")
order by r.valor desc
limit 1
*/