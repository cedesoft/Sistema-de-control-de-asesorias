<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Imports\DocentesImport;
use App\Imports\UserImport;
use App\Docentes;
use App\Carreras;
use App\User;
use App\Roles;


class DocentesController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = Docentes::all()->where('state','1');
        $carreras = DB::table('carreras')->get();

        return view('admin/agregar_docente_admin', compact('docentes', 'carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docente = new Docentes();
        $docente->nombre = $request->input('nombre'); 
        $docente->correo = $request->input('email');
        $docente->contraseña = $request->input('pass');
        $docente->imagen = "null";
        $docente->id_carrera = $request->input('carrera');
        
        $docente->save();

        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('pass'));

        $user->save();
        $user->roles()->attach(Roles::where('nombre', 'docente')->first());

        return redirect(action('DocentesController@create'))->with('success','Docente creado exitosamente');
    }

    public function import(){
        (new DocentesImport)->import(request()->file('excel'));
        (new UserImport)->import(request()->file('excel'));

        return redirect(action('DocentesController@create'))->with('success','Docente creado exitosamente');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $docente = Docentes::whereId($id)->firstOrFail();
        $docente->state = 0;
        $docente->save();

        return redirect(action('DocentesController@create'))->with('success','Docente eliminado exitosamente');
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
