<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rango;

class RangosController extends Controller
{
    public function index() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
    	$rangos = Rango::orderBy('valor')->get();
		return view('rangos.lista', compact('rangos'));
	}

	public function add() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');

		return view('rangos.create');
	}

	public function store(Request $request) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');

        $this->validate(request(), [
                'nombre' => 'required|string',
                'valor' => 'required|numeric|min:1'
            ]);

        $rango_attrs = [
            'nombre' => request()->nombre,
            'valor' => request()->valor
        ];

        $rango_existente = Rango::where('valor', request()->valor)->first();
        if (!empty($rango_existente)) {

            //redirigir
            return redirect('/admin/rangos')->withErrors('El valor del rango ya existe.');
        }
        //crear y guardar
        Rango::create($rango_attrs);

        session()->flash('alert', 'Rango agregado!');

        //redirigir
        return redirect('/admin/rangos');



	}

	public function edit($id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
		$rango = Rango::findOrFail($id);
		return view('rangos.edit', compact('rango'));
	}

	public function update(Request $request,$id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        $rango_existente = Rango::where('valor', request()->valor)->first();
        if (!empty($rango_existente)) {

            //redirigir
            return redirect('/admin/rangos')->withErrors('El valor del rango ya existe.');
        }

        $rango = Rango::findOrFail($id);
        $rango->nombre = (request()->has('nombre')) ? request()->nombre : $rango->nombre;
        $rango->valor = (request()->has('valor')) ? request()->valor : $rango->valor;
        $rango->save();
        session()->flash('alert', 'Los cambios han sido guardados con éxito');
        return redirect('/admin/rangos');
	}

	public function delete($id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
		$rango_eliminar = Rango::findOrFail($id);
		if ($rango_eliminar['valor'] < 0) {
			return redirect()->back()->withErrors('No se puede eliminar el rango negativo!');
		}
		elseif ($rango_eliminar['valor'] === 0) {
			return redirect()->back()->withErrors('No se puede eliminar el rango neutral!');
		}
        elseif ($rango_eliminar['valor'] === 1) {
            return redirect()->back()->withErrors('No se puede eliminar el rango Buena Persona!');
        }

        $rango_eliminar->delete();
        
        session()->flash('alert', 'Rango eliminado');

        return redirect()->back();
	}
}
