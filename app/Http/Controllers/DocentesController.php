<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Imports\DocentesImport;
use App\Imports\UserImport;
use App\Docentes;
use App\Alumnos;
use App\Carreras;
use App\User;
use App\Roles;
use App\Asesoria;
use App\SolicitudAlumno;
use App\SolicitudDocente;
use App\Agregados;

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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['docente']);

        $request->user()->authorizeRoles(['docente']);
        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();
        return view('docente.inicio_docente', compact('docente'));

    }

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

        $docentes = Docentes::all()->where('state','1');
        $carreras = DB::table('carreras')->get();

        return view('admin/agregar_docente_admin', compact('docentes', 'carreras','coordi'));
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

        return redirect(action('DocentesController@create'))->with('success','Docentes creados exitosamente');
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
        $docente = Docentes::whereId($id)->firstOrFail();
        $docente->state = 0;
        $docente->save();

        return redirect(action('DocentesController@create'))->with('success','Docente eliminado exitosamente');
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

        $id = $request->input('docente_id');
        $docente = Docentes::whereId($id)->firstOrFail();
        $docente->nombre = $request->input('name');
        $docente->correo = $request->input('email');
        $docente->contraseña = $request->input('pass');
        $docente->save();

        return redirect(action('DocentesController@create'))->with('success','Docente editado exitosamente');
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
        $carreras = DB::table('carreras')->get();
        $docentes = DB::table('docentes')->where('nombre','like','%'.$nombre.'%')->where('state','1')->get();
        return view('admin/agregar_docente_admin', compact('docentes', 'carreras','coordi'));
    }

    public function solicitudes(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        $solicitudes_recibidas = DB::table('solicitud_alumnos')
                            ->leftjoin('docentes','solicitud_alumnos.id_docente','=','docentes.id')
                            ->leftjoin('materias','solicitud_alumnos.id_materia','=','materias.id')
                            ->leftjoin('alumnos','solicitud_alumnos.id_alumno','=','alumnos.id')
                            ->select('solicitud_alumnos.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('solicitud_alumnos.state','=','1')
                            ->where('solicitud_alumnos.status','=','pendiente')
                            ->get();

        $asesorias = DB::table('asesorias')
                            ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                            ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                            ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                            ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('asesorias.state','=','1')
                            ->where('asesorias.status','=','Aceptada')
                            ->get();
        
        $asesorias_terminadas = DB::table('asesorias')
                            ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                            ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                            ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                            ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('asesorias.state','=','1')
                            ->where('asesorias.status','=','Terminada')
                            ->get();

        $asesorias_canceladas = DB::table('asesorias')
                            ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                            ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                            ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                            ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('asesorias.state','=','1')
                            ->where('asesorias.status','=','Cancelada')
                            ->get();

        $solicitudes = DB::table('solicitud_docentes')
                            ->leftjoin('docentes','solicitud_docentes.id_docente','=','docentes.id')
                            ->leftjoin('materias','solicitud_docentes.id_materia','=','materias.id')
                            ->leftjoin('alumnos','solicitud_docentes.id_alumno','=','alumnos.id')
                            ->select('solicitud_docentes.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                            ->where('solicitud_docentes.state','=','1')
                            ->where('solicitud_docentes.status','=','Pendiente')
                            ->get();
                            
        return view('docente/asesorias_docente', compact('solicitudes','asesorias','solicitudes_recibidas','asesorias_terminadas','asesorias_canceladas','docente'));
    }

    public function confirmar(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $asesoria = new Asesoria();
        $asesoria->status = "Aceptada";
        $asesoria->fechaSolicitud = $request->input('fecha_solicitud');
        $asesoria->fechaRealizacion = $request->input('fecha_realizacion');
        $asesoria->fechaTerminacion = $request->input('fecha_terminacion');
        $asesoria->lugar = $request->input('lugar');
        $asesoria->unidad = $request->input('unidad');
        $asesoria->tema = $request->input('tema');
        $asesoria->id_docente = $request->input('id_docente');
        $asesoria->id_alumno = $request->input('id_alumno');
        $asesoria->id_materia = $request->input('id_materia');
        $asesoria->save();

        $id = $request->input('id');
        $solicitud = SolicitudAlumno::whereId($id)->firstOrFail();
        $solicitud->status = "Aceptada";
        $solicitud->save();

        $alumno = DB::table('alumnos')->where('id',$asesoria->id_alumno)->first();

        $email = $alumno->correo;
        $usuario = $request->user()->name;
        $reciver = $alumno->nombre;
        $unidad = $asesoria->unidad;
        $materia = $asesoria->id_materia;
        $tema = $asesoria->tema;

        $controller = new MailController();
        $controller->sendAceptada($email, $usuario, $reciver, $unidad, $materia, $tema);

        return redirect(action('DocentesController@solicitudes'))->with('success','Se ha confirmado la asesoria');
    }

    public function Materias(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        $materias = DB::table('materias')
                        ->leftJoin('docentes','materias.id_docente','=','docentes.id')
                        ->select('materias.*','docentes.nombre as nombre_docente')
                        ->where('materias.id_docente',$docente->id)
                        ->get();

        return view('docente/materias_docente', compact('materias','docente'));
    }

    public function Solicitar(Request $request, $materia){
        $request->user()->authorizeRoles(['docente']);

        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        $nom_materia = DB::table('materias')->where('id',$materia)->first();
        /* $materias = DB::table('materias')
                        ->leftJoin('docentes','materias.id_docente','=','docentes.id')
                        ->select('materias.*')
                        ->where('docentes.nombre',$nombre)
                        ->get(); */

        $alumnos = 0;
        $agregados = DB::table('alumnos_agregados')
                        ->leftjoin('alumnos','alumnos_agregados.num_control','=','alumnos.id')
                        ->select('alumnos_agregados.*','alumnos.nombre','alumnos.id_carrera')
                        ->get();
        return view('docente/solicitud_docente', compact('materia','nom_materia','alumnos','agregados','docente'));
    }

    public function buscar(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        $id = $request->input('id');
        $alumnos = 1;
        $alumno = DB::table('alumnos')->where('id',$id)->get();

        $materia = $request->input('materia');
        $nom_materia = DB::table('materias')->where('id',$materia)->first();

        $agregados = DB::table('alumnos_agregados')
                        ->leftjoin('alumnos','alumnos_agregados.num_control','=','alumnos.id')
                        ->select('alumnos_agregados.*','alumnos.nombre','alumnos.id_carrera')
                        ->get();

        return view('docente/solicitud_docente', compact('alumno', 'alumnos','agregados','docente','materia','nom_materia'));
    }

    public function AgregarAlumnos(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        $agregar = new Agregados();
        $agregar->num_control = $request->input('num_control');
        $agregar->save();
        $alumnos = 0;

        $materia = $request->input('materia');
        $nom_materia = DB::table('materias')->where('id',$materia)->first();

        $agregados = DB::table('alumnos_agregados')
                        ->leftjoin('alumnos','alumnos_agregados.num_control','=','alumnos.id')
                        ->select('alumnos_agregados.*','alumnos.nombre','alumnos.id_carrera')
                        ->get();

        return view('docente/solicitud_docente', compact('alumnos','agregados','docente','materia','nom_materia'));
    }

    public function EliminarAlumnoAgregado(Request $request, $get_materia, $num_control){
        $request->user()->authorizeRoles(['docente']);

        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        DB::table('alumnos_agregados')->where('num_control','=',$num_control)->delete();
        $alumnos = 0;

        $materia = $get_materia;
        $nom_materia = DB::table('materias')->where('id',$materia)->first();

        $agregados = DB::table('alumnos_agregados')
                        ->leftjoin('alumnos','alumnos_agregados.num_control','=','alumnos.id')
                        ->select('alumnos_agregados.*','alumnos.nombre','alumnos.id_carrera')
                        ->get();

        return view('docente/solicitud_docente', compact('alumnos','agregados','docente','materia','nom_materia'));
    }

    public function RealizarSolicitud(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $contador = $request->input('contador');
        for($i = 0;$i<$contador;$i++){
            $solicitar = new SolicitudDocente();
            $solicitar->status = "Pendiente";
            $solicitar->fechaSolicitud = date("y").'/'.date("m").'/'.date("d");
            $solicitar->fecha_realizacion = $request->input('fecha_realizacion');
            $solicitar->fecha_terminacion = $request->input('fecha_terminacion');
            $solicitar->lugar = $request->input('lugar');
            $solicitar->tema = $request->input("tema");
            $solicitar->unidad = $request->input("unidad");
            $solicitar->situacion_academica = $request->input("situacion_academica");
            $solicitar->id_docente = $request->input('docente');
            $solicitar->id_materia = $request->input('materia');
            $solicitar->id_alumno = $request->input($i+1);
            $solicitar->save();
            DB::table('alumnos_agregados')->where('num_control','=',$request->input($i+1))->delete();

            $alumno = DB::table('alumnos')->where('id',$solicitar->id_alumno)->first();

            $email = $alumno->correo;
            $usuario = $request->user()->name;
            $reciver = $alumno->nombre;
            $unidad = $solicitar->unidad;
            $materia = $solicitar->id_materia;
            $tema = $solicitar->tema;

            $controller = new MailController();
            $controller->send($email, $usuario, $reciver, $unidad, $materia, $tema);
        }

        return redirect(action('DocentesController@Materias'))->with('success','Se ha solicitado la asesoria');
    }

    public function cancelar(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $id = $request->input('id');
        $solicitud = SolicitudDocente::whereId($id)->firstOrFail();
        $solicitud->state = 0;
        $solicitud->save();

        return redirect(action('DocentesController@solicitudes'));
    }

    public function cancelarAsesoria(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $id = $request->input('id');
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Cancelada";
        $asesoria->save();

        return redirect(action('DocentesController@solicitudes'));
    }

    public function ActualizarAsesoria(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $id = $request->input('id');
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->fechaRealizacion = $request->get('fecha_realizacion');
        $asesoria->fechaTerminacion = $request->get('fecha_terminacion');
        $asesoria->tema = $request->get('tema');
        $asesoria->save();

        return redirect(action('DocentesController@solicitudes'));
    }

    public function TerminarAsesoria(Request $request){
        $request->user()->authorizeRoles(['docente']);

        $id = $request->input('id');
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Terminada";
        $asesoria->observaciones = $request->input('observaciones');
        $asesoria->save();

        return redirect(action('DocentesController@solicitudes'));
    }

    public function Perfil(Request $request){
        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();
        return view('docente.perfil', compact('docente'));
    }

    public function AgregarImagen(Request $request){
        $nombre = $request->user()->name;
        $docente = DB::table('docentes')->where('nombre',$nombre)->first();

        $docentes = Docentes::whereId($docente->id)->firstOrFail();
        if($request->hasfile('foto')){
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/Imagenes/', $filename);
            $docentes->imagen = $filename;
        }else{
            return $request;
            $docentes->imagen = '';
        }

        $docentes->save();

        return redirect(action('DocentesController@Perfil'));
    }
}
