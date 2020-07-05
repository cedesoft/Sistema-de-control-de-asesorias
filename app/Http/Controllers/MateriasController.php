<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\MateriasImport;
use App\Materias;
use App\Docentes;

class MateriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);

        $nombre = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre)->first();

        $materias = DB::table('materias')->orderBy('id')->where('state','1')->paginate(10);
        $carreras = DB::table('carreras')->get();
        $docentes = DB::table('docentes')->where('state','1')->get();
        $page = true;
        return view('admin/agregar_materias_admin', compact('materias','carreras','docentes','coordi','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);

        $materia = new Materias();
        $materia->id = $request->input('clave'); 
        $materia->nombre = $request->input('nombre');
        $materia->descripcion = "null";
        $materia->creditos = $request->input('creditos');
        $materia->horas = $request->input('horas');
        $materia->semestre = $request->input('semestre');
        $materia->id_carrera = $request->input('carrera');
        $materia->id_docente = $request->input('docente');

        $materia->save();
        return redirect(action('MateriasController@index'))->with('success','Materia creada exitosamente');
    }

    public function import(){
        (new MateriasImport)->import(request()->file('excel'));

        return redirect(action('MateriasController@index'))->with('success','Materia creada exitosamente');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);

        $id = $request->input('id');
        $materia = Materias::whereId($id)->firstOrFail();
        $materia->state = 0;
        $materia->save();

        return redirect(action('MateriasController@index'))->with('success','Materia eliminada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);

        $nombre_c = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre_c)->first();

        $nombre = $request->input('buscar');
        $materias = DB::table('materias')->where('nombre','like','%'.$nombre.'%')->where('state','1')->get();
        $carreras = DB::table('carreras')->get();
        $docentes = DB::table('docentes')->where('state','1')->get();
        $page = false;
        return view('admin/agregar_materias_admin', compact('materias','carreras','docentes','coordi','page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);
        
        $id = $request->input('id_materia');
        $materia = Materias::whereId($id)->firstOrFail();
        $materia->nombre = $request->input('name');
        $materia->creditos = $request->input('creditos');
        $materia->horas = $request->input('horas');
        $materia->semestre = $request->input('semestre');
        $materia->save();

        return redirect(action('MateriasController@index'))->with('success','Materia editada exitosamente');
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
}
