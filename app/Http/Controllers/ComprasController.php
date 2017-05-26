<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Compra;

class ComprasController extends Controller
{
    public function generar() {
        
        if(! $this->validarCompra()) {
            return redirect()->back()->withErrors('La tarjeta es invalida');
        }

        $this->crearCompra();

        $this->agregarCreditosAUsuario();

        return redirect()->back();
    
    }

    public function validarCompra() {
        
        // Validar datos de la tarjeta de credito acá
        // $nombre_completo = request()->nombre_completo
        // $numero_tarjeta = request()->numero_tarjeta
        // $codigo_verificacion = request()->codigo_verificacion
        // $fecha_inicio = request()->fecha_inicio
        // $fecha_expiracion = request()->fecha_expiracion

        return true;

    }

    protected function crearCompra() {

        Compra::create([
            'user_id' => Auth::user()->id,
            'precio_unitario' => config('app.precio_credito'),
            'cantidad' => request()->cantidad_creditos
        ]);

    }

    protected function agregarCreditosAUsuario() {

        $user = Auth::user();

        $user->credits = $user->credits + request()->cantidad_creditos;

        $user->save();

    }

}
