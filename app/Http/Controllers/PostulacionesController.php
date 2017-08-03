<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gauchada;
use App\Postulacion;

class PostulacionesController extends Controller
{
    public function add(Request $request) {
        if (!Auth::check() || Auth::user()->esAdmin()) {
            return redirect('/home');
        }
        if (Auth::user()->cant_postulaciones(request()->gauchada) > 0) {
            //Postulacion::where('postulante', Auth::user()->id)->where('gauchada', request()->gauchada)->delete();
            //session()->flash('alert', 'Postulación cancelada correctamente!');
            return redirect()->back()->withErrors('Ya estás postulado!');
        }
        $postulacion_attrs = [
            'postulante' => Auth::user()->id,
            'gauchada' => request()->gauchada
        ];
        Postulacion::create($postulacion_attrs);
        session()->flash('alert', 'Postulación correcta!');
        return redirect()->back();
    }

    public function accept($id) {
    	$postulacion = Postulacion::find($id);
    	
    	$gauchada = Gauchada::find($postulacion['gauchada']);
        
        if (!empty($gauchada['aceptado'])) {
            return redirect()->back()->withErrors(['ya_aceptado' => 'Lo sentimos, ya se ha aceptado un postulante!']);
        } else {
            $gauchada['aceptado'] = $postulacion['postulante'];
            $gauchada->save();
            session()->flash('alert', 'Postulación aceptada!');
            return redirect()->back();
        }


    }
}
