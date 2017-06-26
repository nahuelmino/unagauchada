<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gauchada;
use App\Pregunta;
use App\Respuesta;
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

    public function getGauchadas($request,$moreClauses = []) {
        $gauchadas = Gauchada::with('categoria')->withCount('postulacions');
        if (isset($request['title'])) {
            $title = request()->title;
            $gauchadas = $gauchadas->where('title', 'LIKE', "%$title%");
        }
        if (isset($request['location'])) {
            $location = request()->location;
            $gauchadas = $gauchadas->where('location', 'LIKE', "%$location%");
        }
        if (isset($request['categoria_id']) && $request['categoria_id'] !== '0') {
            $categoria_id = request()->categoria_id;
            $gauchadas = $gauchadas->where('categoria_id', 'LIKE', "%$categoria_id%");
        }
        // 2017-05-29: En el próximo sprint, esto tiene que traerlas ordenadas por cantidad de postulantes de menor a mayor
        if (! isset($request['DbgAllGauchadas'])) {
            $gauchadas = $gauchadas->whereRaw('ends_at >= CURRENT_DATE()')
                                   ->whereNull('aceptado');
        }            

        if (isset($request['sortByPostulaciones']) && $request['sortByPostulaciones'] === '1') {
            $gauchadas = $gauchadas->orderBy('postulacions_count');
        }
        foreach ($moreClauses as $clause) {
                                                       
            $gauchadas = $gauchadas->where($clause['k'], $clause['op'], $clause['v']);
            
        }
        return $gauchadas->paginate(6);
    }

    public function index($clauses = [])
    {
        $request = request()->toArray();
        $gauchadas = $this->getGauchadas($request,$clauses);
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
        // Eliminar la gauchada implica:
        // Verificar que la gauchada que estoy eliminando es mía
        // Verificar que no haya un postulante aceptado
        // Si hay 0 postulantes hay que devolver el credito que se usó para publicar la gauchada
        // Borrar de la tabla "postulacions" las postulaciones a la gauchada que estoy eliminando
        // Borrar la gauchada de la tabla "gauchadas" 

        $gauchada = Gauchada::findOrFail($id);
        
        if (!$this->verificarGauchadaEsMia($gauchada)) {
            return redirect()->back()->withErrors('Hubo un error');
        } 

        if (!$this->verificarPostulanteAceptado($gauchada)) {
            return redirect()->back()->withErrors('Esta gauchada ya tiene un postulante aceptado.');
        }
        
        if ($gauchada->postulacions->count() === 0) {
            $this->devolverCredito();
        }
        
        $gauchada->borrarPostulantes();

        $gauchada->delete();
        
        session()->flash('alert', 'Gauchada eliminada');

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

    public function userGauchadas() {
        if (!Auth::check() || Auth::user()->esAdmin())
            return redirect('/home');
        $user = Auth::user()->id;
        return $this->index([[
            'k' => 'creado_por',
            'op' => '=',
            'v' => "$user"
        ]]);
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
}
