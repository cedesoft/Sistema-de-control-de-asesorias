<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Coordinador;
use App\Carreras;
use App\User;
use App\Roles;

class CoordiController extends Controller
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
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $nombre = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre)->first();

        $coordinador = Coordinador::all()->where('state','1');
        $carreras = DB::table('carreras')->get();

        return view('admin/agregar_coordi', compact('coordinador', 'carreras','coordi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $coordinador = new Coordinador();
        $coordinador->nombre = $request->input('nombre'); 
        $coordinador->correo = $request->input('email');
        $coordinador->contraseña = $request->input('pass');
        $coordinador->imagen = "null";
        $coordinador->id_carrera = $request->input('carrera');
        
        $coordinador->save();

        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('pass'));

        $user->save();
        $user->roles()->attach(Roles::where('nombre', 'coordinador')->first());

        return redirect(action('CoordiController@create'))->with('success','Coordinador creado exitosamente');
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
    public function edit(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $id = $request->input('docente_id');
        $coordinador = Coordinador::whereId($id)->firstOrFail();
        $coordinador->nombre = $request->input('name');
        $coordinador->correo = $request->input('email');
        $coordinador->contraseña = $request->input('pass');
        $coordinador->save();

        return redirect(action('CoordiController@create'))->with('success','Coordinador editado exitosamente');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $id = $request->input('id');
        $coordinador = Coordinador::whereId($id)->firstOrFail();
        $coordinador->state = 0;
        $coordinador->save();

        return redirect(action('CoordiController@create'))->with('success','Coordinador eliminado exitosamente');
    }

    public function Perfil(Request $request){
        $request->user()->authorizeRoles(['coordinador']);
        $nombre = $request->user()->name;
        $coordinador = DB::table('coordinador')->where('nombre',$nombre)->first();
        return view('coordinador.perfil', compact('coordinador'));
    }

    public function AgregarImagen(Request $request){
        $request->user()->authorizeRoles(['coordinador']);
        $nombre = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre)->first();

        $coordinador = Coordinador::whereId($coordi->id)->firstOrFail();
        if($request->hasfile('foto')){
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/Imagenes/', $filename);
            $coordinador->imagen = $filename;
        }else{
            return $request;
            $coordinador->imagen = '';
        }

        $coordinador->save();

        return redirect(action('CoordiController@Perfil'));
    }
}
