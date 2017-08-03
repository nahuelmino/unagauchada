<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categoria;

class CategoriasController extends Controller
{
    public function index() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        $categorias = Categoria::withCount('gauchadas')->get();
		return view('categorias.lista', compact('categorias'));
	}

	public function add() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
		return view('categorias.create');
	}

	public function store(Request $request) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');

        $this->validate(request(), [
                'name' => 'required|string'
            ]);

        $categoria_attrs = [
            'name' => request()->name
        ];

        $categoria_existente = Categoria::where('name', request()->name)->first();
        if (!empty($categoria_existente)) {
            return redirect('/admin/categorias')->withErrors('Ya existe una categoria con ese nombre');
        }

        //crear y guardar
        Categoria::create($categoria_attrs);

        session()->flash('alert', 'Categoria agregada!');

        //redirigir
        return redirect('/admin/categorias');
	}

	public function edit($id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        //$gauchadas = \App\Gauchada::where('categoria_id',$id)->count();
        $categoria = Categoria::findOrFail($id);//->withCount(\App\Gauchada::where('categoria_id',$id));
		//dd($categoria);
        return view('categorias.edit', compact('categoria'));
	}

	public function update(Request $request,$id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');

        $categoria_existente = Categoria::where('name', request()->name)->first();
        if (!empty($categoria_existente)) {
            return redirect('/admin/categorias')->withErrors('Ya existe una categoria con ese nombre');
        }

        $categoria = Categoria::findOrFail($id);
        $categoria->name = (request()->has('name')) ? request()->name : $categoria->name;
        $categoria->save();
        session()->flash('alert', 'Los cambios han sido guardados con éxito');
        return redirect('/admin/categorias');
	}

	public function delete($id) {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
		$rango_eliminar = Categoria::findOrFail($id);

		$tiene_gauchadas = \App\Gauchada::where('categoria_id',$id)->count();
		if ($tiene_gauchadas > 0)
			return redirect()->back()->withErrors('No se puede eliminar una categoría con gauchadas!');

        $rango_eliminar->delete();

        session()->flash('alert', 'Categoria eliminada');

        return redirect()->back();
	}
}
