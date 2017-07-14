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
    	//dd($rangos);
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

        //crear y guardar
        Rango::create($rango_attrs);

        session()->flash('alert', 'Rango agregado!');

        //redirigir
        return redirect('/admin/rangos');
	}

	public function edit($id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
		return view('rangos.edit');
	}

	public function update(Request $request,$id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
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

        $rango_eliminar->delete();
        
        session()->flash('alert', 'Rango eliminado');

        return redirect()->back();
	}
}
