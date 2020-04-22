<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\MateriasImport;
use App\Materias;

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
    public function index()
    {
        //$materias = Materias::all()->where('state','1');
        $materias = DB::table('materias')->where('state','1')->get();

        return view('admin/agregar_materias_admin', compact('materias'));
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
        $materia = new Materias();
        $materia->id = $request->input('clave'); 
        $materia->nombre = $request->input('nombre');
        $materia->descripcion = "null";
        $materia->creditos = $request->input('creditos');
        $materia->horas = $request->input('horas');
        
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
        $id = $request->input('id');
        $materia = Materias::whereId($id)->firstOrFail();
        $materia->state = 0;
        $materia->save();

        return redirect(action('MateriasController@index'))->with('success','Materia eliminada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
}
