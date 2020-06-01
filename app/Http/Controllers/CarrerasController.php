<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Carreras;

class CarrerasController extends Controller
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
        $nombre = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre)->first();
        $carreras = DB::table('carreras')->where('state','1')->get();

        return view('admin/agregar_carrera_admin', compact('carreras','coordi'));
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
        $carrera = new Carreras();
        $carrera->id = $request->input('clave');
        $carrera->nombre = $request->input('nombre');

        $carrera->save();

        return redirect(action('CarrerasController@index'))->with('success','Carrea creada exitosamente');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $carrera = Carreras::whereId($id)->firstOrFail();
        $carrera->state = 0;
        $carrera->save();

        return redirect(action('CarrerasController@index'))->with('success','Carrera eliminada exitosamente');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('clave');
        $carrera = Carreras::whereId($id)->firstOrFail();
        $carrera->id = $request->input('clave');
        $carrera->nombre = $request->input('nombre');

        $carrera->save();

        return redirect(action('CarrerasController@index'))->with('success','Carrea editada exitosamente');
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
