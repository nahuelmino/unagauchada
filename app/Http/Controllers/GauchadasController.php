<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gauchada;
use App\Pregunta;
use App\Respuesta;
use App\Postulacion;
use App\Calificacion;
use App\User;
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

    public function index() {
        $request = request()->toArray();
        $gauchadas = $this->getAllGauchadas($request);
        $categorias = Categoria::all();
        return view('gauchadas.lista', compact('gauchadas'))->withCategorias($categorias)->withRequest($request);
    }

    public function userGauchadas() {
        if (!Auth::check() || Auth::user()->esAdmin())
            return redirect('/home');

        $request = request()->toArray();
        $gauchadas = $this->getUserGauchadas($request);
        $categorias = Categoria::all();
        return view('gauchadas.lista', compact('gauchadas'))->withCategorias($categorias)->withRequest($request);
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

        if (! $this->checkCreditos()) {
            return redirect()->back()->withErrors('No tiene suficientes créditos! Si querés, podés comprar creditos <a href="/comprar">acá.</a>');
        }

        if (! $this->checkearGauchadasSinCalificar()) {
            return redirect()->back()->withErrors('Tenes gauchadas en las que no calificaste a tu postulante! No podes crear gauchadas hasta que los califiques.');
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

        if (! $this->checkearGauchadasSinCalificar()) {
            return redirect()->back()->withErrors('Tenes gauchadas en las que no calificaste a tu postulante! No podes crear gauchadas hasta que los califiques.');
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
            $directory = 'gauchadas';
            $path =  '/storage/' . request()->file('photo')->store($directory, 'public');
            //dd($path);
            $gauchada_attrs['photo'] = $path;//'/storage/' . 
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
        $postulacions = Postulacion::where('gauchada',$id);
        $preguntas = Pregunta::all()->where('gauchada',$id);
        foreach ($preguntas as $pregunta) {
            $pregunta['respuesta'] = Respuesta::all()->where('pregunta',$pregunta['id'])->first();
        }
        //dd($preguntas);
        return view('gauchadas.show')->withGauchada($gauchada)->withPostulacions($postulacions)->withPreguntas($preguntas);
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
        if (Auth::user()->id !== $gauchada['creado_por']) {
            return redirect('/home');
        }
        return view('gauchadas.edit')->withGauchada($gauchada)->withCategorias(Categoria::all());
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
        $gauchada = Gauchada::findOrFail($id);
        $gauchada->title = (request()->has('title')) ? request()->title : $gauchada->title;
        $gauchada->description = (request()->has('description')) ? request()->description : $gauchada->description;
        $gauchada->location = (request()->has('location')) ? request()->location : $gauchada->location;
        $gauchada->ends_at = (request()->has('ends_at')) ? Carbon::createFromFormat('d/m/Y',request()->ends_at)->format('Y-m-d') : $gauchada->ends_at;//request()->ends_at
        $gauchada->categoria_id = (request()->has('categoria_id')) ? request()->categoria_id : $gauchada->categoria_id;
        if (request()->hasFile('photo')) {
            $directory = 'usuarios';
            $path = '/storage/' . request()->photo->store($directory, 'public');
            $gauchada->photo = $path;
        }
        $gauchada->save();
        session()->flash('alert', 'Los cambios han sido guardados con éxito');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar la gauchada implica:
        // Verificar que la gauchada que estoy eliminando es mía
        // Verificar que no haya un postulante aceptado
        // Si no hay postulantes aceptados devolver el credito invertido
        // Borrar de la tabla "postulacions" las postulaciones a la gauchada que estoy eliminando
        // Borrar la gauchada de la tabla "gauchadas" 

        $gauchada = Gauchada::findOrFail($id);
        
        if (!$this->verificarGauchadaEsMia($gauchada)) {
            return redirect()->back()->withErrors('Hubo un error');
        } 

        if (!$this->verificarPostulanteAceptado($gauchada)) {
            return redirect()->back()->withErrors('Esta gauchada ya tiene un postulante aceptado.');
        }
        
      /*  if ($gauchada->postulacions->count() === 0) { */
            $this->devolverCredito();
     //   }
        
        $gauchada->borrarPostulantes();

        $gauchada->delete();
        
        session()->flash('alert', 'Gauchada eliminada');

        return redirect()->back();

    }

    protected function checkearGauchadasSinCalificar() {
        $user = Auth::user();
        
        return !$user->gauchadas->contains(function($gauchada) {
            return !$gauchada->calificada() && $gauchada->tienePostulanteAceptado();
        });
    }

    public function postulaciones($id) {
        $gauchada = Gauchada::findOrFail($id);
        if (!Auth::check() || Auth::user()->id !== $gauchada['creado_por']) {
            return redirect('/home');
        }
        $postulaciones = Postulacion::where('gauchada',$id)->get();
        $calificaciones = Calificacion::all();
        return view('gauchadas.postulaciones')->withGauchada($gauchada)->withPostulaciones($postulaciones)->withCalificaciones($calificaciones);
    }

    public function calificar($id) {
        if (request()->has('calificacion_id')) {
            $gauchada = Gauchada::findOrFail($id);
            $calificacion = Calificacion::findOrFail(request()->calificacion_id);
            $aceptado = User::findOrFail($gauchada->aceptado);
            $aceptado->score += $calificacion->score;

            if ($calificacion->name === 'Buena') {
                $aceptado->credits += 1;
            }
            
            $gauchada->calificacion_id = $calificacion->id;

            $aceptado->save();
            $gauchada->save();

            session()->flash('alert', 'Calificaste a tu postulante correctamente!');
        }
        
        return redirect()->back();
    }

    protected function verificarGauchadaEsMia($gauchada) {
        $user = Auth::user();

        return $gauchada->publicado->id === $user->id;
    }

    protected function verificarPostulanteAceptado($gauchada) { 
        return !$gauchada->tienePostulanteAceptado();
    }

    protected function devolverCredito() {
        $user = Auth::user();

        $user->credits += 1;

        $user->save();
    }

    protected function aplicarFiltros($gauchadas) {
        if (request()->has('title')) {
            $title = request()->title;
            $gauchadas = $gauchadas->where('title', 'LIKE', "%$title%");
        }
        if (request()->has('location')) {
            $location = request()->location;
            $gauchadas = $gauchadas->where('location', 'LIKE', "%$location%");
        }
        if (request()->has('categoria_id') && request()->categoria_id !== '0') {
            $categoria_id = request()->categoria_id;
            $gauchadas = $gauchadas->where('categoria_id', 'LIKE', "%$categoria_id%");
        }

        return $gauchadas;
    }

    protected function getAllGauchadas() {
        $gauchadas = Gauchada::with('categoria')->withCount('postulacions');
        //dd($gauchadas->pluck('postulacions_count'));//Gauchada::with('categoria')->with('postulacions')->get());
        
        $gauchadas = $this->aplicarFiltros($gauchadas);

        if (! isset(request()->DbgAllGauchadas)) {
            $gauchadas = $gauchadas->whereRaw('ends_at >= CURRENT_DATE()')
                                   ->whereNull('aceptado');
        }

        if (isset(request()['sortByPostulaciones']) && request()['sortByPostulaciones'] === '1') {
            $gauchadas = $gauchadas->orderBy('postulacions_count');
        }

        return $gauchadas->paginate(6);
    }

    protected function getUserGauchadas() {

        $gauchadas = Gauchada::with('categoria')
                              ->withCount('postulacions')
                              ->where('creado_por', Auth::user()->id);
        
        $gauchadas = $this->aplicarFiltros($gauchadas);

        if (isset(request()['sortByPostulaciones']) && request()['sortByPostulaciones'] === '1') {
            $gauchadas = $gauchadas->orderBy('postulacions_count');
        }

        if (! isset(request()->DbgAllGauchadas)) {
            $gauchadas = $gauchadas->whereNull('calificacion_id');
        }

        return $gauchadas->paginate(6);
    }
}
