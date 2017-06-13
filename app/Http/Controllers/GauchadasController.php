<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gauchada;
use App\Postulacion;
use Carbon\Carbon;

class GauchadasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('title')) {
            $title = request()->title;
            $gauchadas = Gauchada::with('categoria')->where('title', 'LIKE', "%$title%")->paginate(5);
        } else {
            // 2017-05-29: En el próximo sprint, esto tiene que traerlas ordenadas por cantidad de postulantes de menor a mayor
            $gauchadas = Gauchada::with('categoria')->latest()->paginate(5);
        }

        $categorias = Categoria::all();
        return view('gauchadas.lista', compact('gauchadas'))->withCategorias($categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->esAdmin()) {
            return redirect('/home');
        }
        $categorias = Categoria::all();
        return view('gauchadas.create')->withCategorias($categorias);
    }

    public function checkCreditos()
    {
        return Auth::user()->credits > 0;
    }

    public function reducirCreditos() {
        $user = Auth::user();
        $user->credits = $user->credits - 1;
        $user->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar

        $this->validate(request(), [
                'title' => 'required|string',
                'description' => 'required|string|min:10|max:255',
                'location' => 'required|string',
                'categoria_id' => 'required|numeric|min:1'
            ]);

        if (! $this->checkCreditos()) {
            return redirect()->back()->withErrors('No tiene suficientes créditos! Si querés, podés comprar creditos <a href="/comprar">acá.</a>');
        }

        $gauchada_attrs = [
            'creado_por' => Auth::user()->id,
            'title' => request()->title,
            'description' => request()->description,
            'location' => request()->location,
            'categoria_id' => request()->categoria_id,//'date_of_birth' => $data['date_of_birth'],
            'ends_at' => Carbon::createFromFormat('d/m/Y',request()->ends_at)->format('Y-m-d')
        ];

        if (request()->hasFile('photo')) {
            $directory = '/gauchadas';
            $path = request()->file('photo')->store($directory, 'public');
            $gauchada_attrs['photo'] = $path;
        }

        //crear y guardar
        Gauchada::create($gauchada_attrs);
        $this->reducirCreditos();

        session()->flash('alert', 'Gauchada publicada');

        //redirigir
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gauchada = Gauchada::findOrFail($id);
        return view('gauchadas.show')->withGauchada($gauchada);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gauchada = Gauchada::findOrFail($id);
        if (!Auth::check() || Auth::user()->id !== $gauchada['creado_por']) {
            return redirect('/home');
        }
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postulate(Request $request) {
        if (!Auth::check() || Auth::user()->esAdmin()) {
            return redirect('/home');
        }
        if (Auth::user()->cant_postulaciones(request()->gauchada) > 0) {
            Postulacion::where('postulante', Auth::user()->id)->where('gauchada', request()->gauchada)->delete();
            session()->flash('alert', 'Postulación cancelada correctamente!');
            return redirect()->back();
        }
        $postulacion_attrs = [
            'postulante' => Auth::user()->id,
            'gauchada' => request()->gauchada
        ];
        Postulacion::create($postulacion_attrs);
        session()->flash('alert', 'Postulación correcta!');
        return redirect()->back();
    }

    public function postulaciones($id) {
        $gauchada = Gauchada::findOrFail($id);
        if (!Auth::check() || Auth::user()->id !== $gauchada['creado_por']) {
            return redirect('/home');
        }
        $postulaciones = Postulacion::where('gauchada',$id)->get();
        return view('gauchadas.postulaciones')->withGauchada($gauchada)->withPostulaciones($postulaciones);
    }
}
