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
use App\Asesoria;
use App\SolicitudAlumno;
use App\SolicitudDocente;
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
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);

        $nombre = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre)->first();

        $alumno = Alumnos::all()->where('state','1');
        $carreras = DB::table('carreras')->get();
        return view('admin/agregar_alumno_admin', compact('carreras','alumno','coordi'));
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

    public function import(Request $request)
    {
        $request->user()->authorizeRoles(['admin','coordinador']);

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
        $request->user()->authorizeRoles(['admin','coordinador']);

        $id = $request->input('id');
        $alumno = Alumnos::whereId($id)->firstOrFail();
        $alumno->state = 0;
        $alumno->save();

        return redirect(action('AlumnosController@create'))->with('success','Alumno eliminado');
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

        $id = $request->input('alumno_id');
        $alumno = Alumnos::whereId($id)->firstOrFail();
        $alumno->nombre = $request->input('name');
        $alumno->correo = $request->input('email');
        $alumno->contraseña = $request->input('pass');
        $alumno->save();

        return redirect(action('AlumnosController@create'))->with('success','Alumno editado');
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
        $alumno = DB::table('alumnos')->where('nombre','like','%'.$nombre.'%')->where('state','1')->get();
        $carreras = DB::table('carreras')->get();
        return view('admin/agregar_alumno_admin', compact('carreras','alumno','coordi'));
    }

    //-------------Funciones para el Alumno-------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user']);
        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();
        return view('alumno/inicio_alumno', compact('alumno'));
    }

    public function lista_Materias(Request $request){
        $request->user()->authorizeRoles(['user']);

        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();

        $materias = DB::table('materias')
                        ->leftJoin('docentes','materias.id_docente','=','docentes.id')
                        ->select('materias.*','docentes.nombre as nombre_docente')
                        ->get();
        //dd($materias);

        return view('alumno/lista_materias', compact('materias','alumno'));
    }

    public function lista_docentes(Request $request){
        $request->user()->authorizeRoles(['user']);

        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();

        $docentes = DB::table('docentes')->where('state','1')->get();
        $materias = DB::table('docentes')
                        ->join('materias','docentes.id','=','materias.id_docente')
                        ->select('materias.nombre as nom_materia','materias.id_docente','materias.id')
                        ->where('materias.state',"=",'1')
                        ->where('docentes.state','=','1')
                        ->get();

        return view('alumno/lista_docentes', compact('docentes','materias','alumno'));
    }

    public function solicitar(Request $request, $id_materia, $id_docente){
        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();

        $materias = DB::table('materias')->where('state','1')->get();
        return view('alumno/solicitar_asesorias', compact('id_docente','id_materia','materias','alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hacer_solicitud(Request $request)
    {
        $request->user()->authorizeRoles(['user']);

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

        $docente = DB::table('docentes')->where('id',$solicitud->id_docente)->first();

        $email = $docente->correo;
        $usuario = $request->user()->name;
        $reciver = $docente->nombre;
        $unidad = $solicitud->unidad;
        $materia = $solicitud->id_materia;
        $tema = $solicitud->tema;

        $controller = new MailController();
        $controller->send($email, $usuario, $reciver, $unidad, $materia, $tema);

        return redirect(action('AlumnosController@solicitudes'));
    }

    public function solicitudes(Request $request){
        $request->user()->authorizeRoles(['user']);
        
        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();

        $request->user()->authorizeRoles(['user']);
        $solicitudes = DB::table('solicitud_alumnos')
                            ->leftjoin('docentes','solicitud_alumnos.id_docente','=','docentes.id')
                            ->leftjoin('materias','solicitud_alumnos.id_materia','=','materias.id')
                            ->leftjoin('alumnos','solicitud_alumnos.id_alumno','=','alumnos.id')
                            ->select('solicitud_alumnos.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('solicitud_alumnos.state','=','1')
                            ->where('solicitud_alumnos.status','=','pendiente')
                            ->where('alumnos.nombre','=',$nombre)
                            ->get();

        $asesorias = DB::table('asesorias')
                            ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                            ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                            ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                            ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('asesorias.state','=','1')
                            ->where('alumnos.nombre','=',$nombre)
                            ->where('asesorias.status','=','Aceptada')
                            ->get();

        $asesorias_terminadas = DB::table('asesorias')
                            ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                            ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                            ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                            ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('asesorias.state','=','1')
                            ->where('alumnos.nombre','=',$nombre)
                            ->where('asesorias.status','=','Terminada')
                            ->get();

        $asesorias_canceladas = DB::table('asesorias')
                            ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                            ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                            ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                            ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('asesorias.state','=','1')
                            ->where('alumnos.nombre','=',$nombre)
                            ->where('asesorias.status','=','Cancelada')
                            ->get();

        $solicitudes_recibidas = DB::table('solicitud_docentes')
                            ->leftjoin('docentes','solicitud_docentes.id_docente','=','docentes.id')
                            ->leftjoin('materias','solicitud_docentes.id_materia','=','materias.id')
                            ->leftjoin('alumnos','solicitud_docentes.id_alumno','=','alumnos.id')
                            ->select('solicitud_docentes.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('solicitud_docentes.state','=','1')
                            ->where('solicitud_docentes.status','=','Pendiente')
                            ->where('alumnos.nombre','=',$nombre)
                            ->get();

        return view('alumno/asesorias_alumno', compact('alumno','solicitudes','asesorias','asesorias_terminadas','asesorias_canceladas','solicitudes_recibidas','alumno'));
    }

    public function cancelar(Request $request){
        $request->user()->authorizeRoles(['user']);

        $id = $request->input('id');
        $solicitud = SolicitudAlumno::whereId($id)->firstOrFail();
        $solicitud->state = 0;
        $solicitud->save();

        return redirect(action('AlumnosController@solicitudes'));
    }

    public function aceptar(Request $request){
        $request->user()->authorizeRoles(['user']);

        $id = $request->input('id');
        $solicitud = SolicitudDocente::whereId($id)->firstOrFail();
        $solicitud->status = "Aceptada";
        $solicitud->save();

        $asesoria = new Asesoria();
        $asesoria->status = "Aceptada";
        $asesoria->fechaSolicitud = $solicitud->fechaSolicitud;
        $asesoria->fechaRealizacion = $solicitud->fecha_realizacion;
        $asesoria->fechaTerminacion = $solicitud->fecha_terminacion;
        $asesoria->lugar = $solicitud->lugar;
        $asesoria->unidad = $solicitud->unidad;
        $asesoria->tema = $solicitud->tema;
        $asesoria->id_docente = $solicitud->id_docente;
        $asesoria->id_alumno = $solicitud->id_alumno;
        $asesoria->id_materia = $solicitud->id_materia;
        $asesoria->save();

        $docente = DB::table('docentes')->where('id',$solicitud->id_docente)->first();
        
        $email = $docente->correo;
        $usuario = $request->user()->name;
        $reciver = $docente->nombre;
        $unidad = $solicitud->unidad;
        $materia = $solicitud->id_materia;
        $tema = $solicitud->tema;

        $controller = new MailController();
        $controller->sendAceptada($email, $usuario, $reciver, $unidad, $materia, $tema);

        return redirect(action('AlumnosController@solicitudes'));
    }

    public function cancelarAsesoria(Request $request){
        $request->user()->authorizeRoles(['user']);

        $id = $request->input('id');
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Cancelada";
        $asesoria->save();

        return redirect(action('AlumnosController@solicitudes'));
    }

    public function ActualizarAsesoria(Request $request){
        $request->user()->authorizeRoles(['user']);

        $id = $request->input('id');
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Aceptada";
        $asesoria->fechaRealizacion = $request->get('fecha_realizacion');
        $asesoria->fechaTerminacion = $request->get('fecha_terminacion');
        $asesoria->lugar = "Null";
        $asesoria->unidad = $request->get('unidad');
        $asesoria->tema = $request->get('tema');
        $asesoria->save();

        return redirect(action('AlumnosController@solicitudes'));
    }

    public function TerminarAsesoria(Request $request){
        $request->user()->authorizeRoles(['user']);

        $id = $request->input('id');
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Terminada";
        $asesoria->save();

        return redirect(action('AlumnosController@solicitudes'));
    }

    public function Perfil(Request $request){
        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();
        return view('alumno.perfil', compact('alumno'));
    }

    public function AgregarImagen(Request $request){
        $nombre = $request->user()->name;
        $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();

        $alumno = Alumnos::whereId($alumno->id)->firstOrFail();
        if($request->hasfile('foto')){
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/Imagenes/', $filename);
            $alumno->imagen = $filename;
        }else{
            return $request;
            $alumno->imagen = '';
        }

        $alumno->save();

        return redirect(action('AlumnosController@Perfil'));
    }

    public function EnviarEmail(Request $request){
        $email = $request->user()->email;
        $usuario = $request->user()->name;
        
        $controller = new MailController();
        $controller->send($email, $usuario);
    }
}
