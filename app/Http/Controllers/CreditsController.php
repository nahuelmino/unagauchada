<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Precio;

class CreditsController extends Controller
{
    public function edit()
    {
    	return view('admin.creditos')
    		->withPrecio( Precio::where('nombre','credito')->first() );
    }

    public function actualizar($nuevo)
    {
    	$precio = Precio::where('nombre','credito')->first();
        $precio->unitario = $nuevo;
        $precio->save();//return config(['gauchadas.precio_credito' => $precio]);
    }

    public function update()
    {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        $this->actualizar( (int) request()->precio_credito );
        session()->flash('alert', 'Precio actualizado');
        return redirect()->back();
    }
}
