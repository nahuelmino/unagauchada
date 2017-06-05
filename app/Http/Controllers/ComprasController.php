<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Compra;

class ComprasController extends Controller
{
    public function generar() {

        $validacion = $this->validarCompra();

        if(! $validacion['esValida']) {
            return redirect()->back()->withErrors($validacion['mensaje']);
        }

        $this->crearCompra();

        $this->agregarCreditosAUsuario();

        return redirect('/home');
    
    }

    public function validarCompra() {
        
        // Validar datos de la tarjeta de credito acá

        if (!(request()->has('nombre_completo'))) {
            return [
                'esValida' => false,
                'mensaje' => 'El nombre es requerido'
            ];
        }


        if (!(request()->has('num_tarjeta'))) {
            return [
                'esValida' => false,
                'mensaje' => 'El número de tarjeta es requerido'
            ];
        } else {
            $numero_tarjeta = str_replace('-', '', request()->num_tarjeta);
            if (strlen($numero_tarjeta) !== 16) {
                return [
                    'esValida' => false,
                    'mensaje' => 'El número de tarjeta es inválido'
                ];
            }
        }

        if (!request()->has('codigo_verificacion')) {
            return [
                'esValida' => false,
                'mensaje' => 'El código de verificación es requerido'
            ];
        } else {
            $codigo_verificacion = (string) request()->codigo_verificacion;

            if (!is_numeric(request()->codigo_verificacion) ||
               (!((strlen($codigo_verificacion) === 3) || (strlen($codigo_verificacion) === 4)) || !(request()->has('codigo_verificacion')))) {
                return [
                    'esValida' => false,
                    'mensaje' => 'El código de verificación es invalido'
                ];
            }
        }

        if (!(request()->has('fecha_inicio'))) {
            return [
                'esValida' => false,
                'mensaje' => 'La fecha de inicio de la tarjeta es requerida'
            ];
        }

        if (!(request()->has('fecha_expiracion'))) {
            return [
                'esValida' => false,
                'mensaje' => 'La fecha de expiración de la tarjeta es requerida'
            ];
        }

        return [
            'esValida' => true,
        ];

    }

    protected function crearCompra() {

        Compra::create([
            'user_id' => Auth::user()->id,
            'precio_unitario' => config('app.precio_credito'),
            'cantidad' => '1'
        ]);

    }

    protected function agregarCreditosAUsuario() {

        $user = Auth::user();

        $user->credits = $user->credits + 1;

        $user->save();

    }

    public function index() {
        return view('creditos.comprar');
    }

}
