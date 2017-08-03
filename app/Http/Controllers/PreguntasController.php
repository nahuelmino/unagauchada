<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pregunta;
use App\Respuesta;

class PreguntasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function store() {

        if (request()->has('gauchada_id') && request()->has('pregunta')) {

            $user = Auth::user();

            $pregunta = new Pregunta;
            $pregunta->text = request()->pregunta;
            $pregunta->user_id = $user->id;
            $pregunta->gauchada = request()->gauchada_id;
            $pregunta->save();

        }   

        return redirect()->back();

    }

    public function update($id) {

        if (request()->has('respuesta')) {
            
            $respuesta = new Respuesta;
            $respuesta->text = request()->respuesta;
            $respuesta->pregunta = $id;
            
            $respuesta->save();

        }

        return redirect()->back();
    }
}
