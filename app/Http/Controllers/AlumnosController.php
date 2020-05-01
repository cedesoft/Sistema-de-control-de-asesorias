<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Alumnos;
use App\Carreras;
use App\User;
use App\Roles;
use App\Materias;
use App\Docentes;
use App\SolicitudAlumno;
use App\Imports\AlumnosImport;
use App\Imports\UserImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class AlumnosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Funciones para el CRUD del Administrador

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

        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('pass'));

        $user->save();
        $user->roles()->attach(Roles::where('nombre', 'user')->first());

        return redirect(action('AlumnosController@create'))->with('success','Alumno creado exitosamente');
    }

    public function import()
    {
        (new AlumnosImport)->import(request()->file('excel'));
        (new UserImport)->import(request()->file('excel'));
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


    //-------------Funciones para el Alumno-------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alumno/inicio_alumno');
    }

    public function lista_Materias(){
        //$materias = DB::table('materias')->where('state','1')->get();
        $materias = DB::table('materias')
                        ->leftJoin('docentes','materias.id_docente','=','docentes.id')
                        ->select('materias.*','docentes.nombre as nombre_docente')
                        ->get();
        //dd($materias);

        return view('alumno/lista_materias', compact('materias'));
    }

    public function lista_docentes(){
        $docentes = DB::table('docentes')->where('state','1')->get();
        $materias = DB::table('docentes')
                        ->join('materias','docentes.id','=','materias.id_docente')
                        ->select('materias.nombre as nom_materia','materias.id_docente','materias.id')
                        ->where('materias.state',"=",'1','AND','docentes.state','=','1')
                        ->get();

        return view('alumno/lista_docentes', compact('docentes','materias'));
    }

    public function solicitar($id_materia, $id_docente){
        //$materias = Materias::all()->where('state','1');
        $materias = DB::table('materias')->where('state','1')->get();
        return view('alumno/solicitar_asesorias', compact('id_docente','id_materia','materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hacer_solicitud(Request $request)
    {
        $solicitud = new SolicitudAlumno();
        $solicitud->status = "pendiente";
        $solicitud->fechaSolicitud = date("y").'/'.date("m").'/'.date("d");
        $solicitud->tema = $request->input('tema');
        $solicitud->unidad = $request->input('unidad');
        $solicitud->situacion_academica = $request->input('situacion');
        $solicitud->id_docente = $request->input('docente');
        $solicitud->id_materia = $request->input('materia');
        $solicitud->id_alumno = $request->input('alumno');

        $solicitud->save();

        return redirect(action('AlumnosController@lista_Materias'));
    }

    public function solicitudes(Request $request){
        $num = $request->user()->num_control;
        //$solicitudes = DB::table('solicitud_alumnos')->where('state','1')->get();
        $solicitudes = DB::table('solicitud_alumnos')
                            ->leftjoin('docentes','solicitud_alumnos.id_docente','=','docentes.id')
                            ->leftjoin('materias','solicitud_alumnos.id_materia','=','materias.id')
                            ->leftjoin('alumnos','solicitud_alumnos.id_alumno','=','alumnos.id')
                            ->select('solicitud_alumnos.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('solicitud_alumnos.state','=','1')
                            ->get();
        return view('alumno/asesorias_alumno', compact('solicitudes','num'));
    }

    public function cancelar(Request $request){
        $id = $request->input('id');
        $solicitud = SolicitudAlumno::whereId($id)->firstOrFail();
        $solicitud->state = 0;
        $solicitud->save();

        return redirect(action('AlumnosController@solicitudes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
}
