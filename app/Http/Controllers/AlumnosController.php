<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Alumnos;
use App\Carreras;
use App\Imports\AlumnosImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumno = Alumnos::all()->where('state','1');
        $carreras = DB::table('carreras')->get();
        return view('admin/agregar_alumno_admin', compact('carreras','alumno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alumno = new Alumnos();
        $alumno->id = $request->input('num_control');
        $alumno->nombre = $request->input('nombre'); 
        $alumno->correo = $request->input('email');
        $alumno->contraseña = $request->input('pass');
        $alumno->imagen = "null";
        $alumno->id_carrera = $request->input('carrera');
        
        $alumno->save();
        return redirect(action('AlumnosController@create'));
    }

    public function import()
    {
        (new AlumnosImport)->import(request()->file('excel'));
        return redirect(action('AlumnosController@create'))->with('success','Archivo importado exitosamente');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $alumno = Alumnos::whereId($id)->firstOrFail();
        $alumno->state = 0;
        $alumno->save();

        return redirect(action('AlumnosController@create'))->with('success','Alumno eliminado');
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
        
    }
}
