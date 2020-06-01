<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Materias;
use App\Docentes;
use App\Alumnos;
use App\SolicitudAlumno;
use App\SolicitudDocente;
use App\Asesoria;

class ApiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMaterias(Request $request)
    {
        $carrera = $request->id_carrera;
        $materias = DB::table('materias')
                        ->leftjoin('docentes','materias.id_docente','=','docentes.id')
                        ->select('materias.*','docentes.nombre as nom_docente')
                        ->where('materias.id_carrera',$carrera)
                        ->where('materias.state',1)
                        ->get();
        return response()->json($materias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMateriasDocente(Request $request)
    {
        $carrera = $request->id_carrera;
        $materias = DB::table('materias')
                        ->leftjoin('docentes','materias.id_docente','=','docentes.id')
                        ->select('materias.*','docentes.nombre as nom_docente')
                        ->where('materias.id_carrera',$carrera)
                        ->where('materias.state',1)
                        ->get();
        return response()->json($materias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDocentes()
    {
        $docentes = DB::table('docentes')->where('state',1)->get();
        return response()->json($docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Docentes(Request $request)
    {
        $carrera = $request->id_carrera;
        $docentes = DB::table('docentes')->where('id_carrera',$carrera)->where('state',1)->get();
        return response()->json($docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAlumnos()
    {
        $alumnos = DB::table('alumnos')->where('state',1)->get();
        return response()->json($alumnos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsuarios()
    {
        $usuarios = DB::table('users')->get();
        return response()->json($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getAsesorias(Request $request)
    {
        $tipo_usuario = $request->tipo;
        $alumno = $request->alumno;
        if($tipo_usuario == "Alumno"){
            $asesoria = DB::table('asesorias')
                    ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                    ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                    ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia')
                    ->where('asesorias.id_alumno',$alumno)
                    ->where('asesorias.status','Aceptada')
                    ->where('asesorias.state',1)
                    ->get();
            return response()->json($asesoria);
        }else{
            $asesoria = DB::table('asesorias')
                    ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                    ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                    ->select('asesorias.*','alumnos.nombre as nom_alumno','materias.nombre as nom_materia')
                    ->where('asesorias.id_docente',$alumno)
                    ->where('asesorias.status','Aceptada')
                    ->where('asesorias.state',1)
                    ->get();
            return response()->json($asesoria);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getAsesoriasTerminadas(Request $request)
    {
        $tipo_usuario = $request->tipo;
        $alumno = $request->alumno;
        if($tipo_usuario == "Alumno"){
            $asesoria =  DB::table('asesorias')
                    ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                    ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                    ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia')
                    ->where('asesorias.id_alumno',$alumno)
                    ->where('asesorias.status','Terminada')
                    ->where('asesorias.state',1)
                    ->get();
            return response()->json($asesoria);
        }else{
            $asesoria =  DB::table('asesorias')
                    ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                    ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                    ->select('asesorias.*','alumnos.nombre as nom_alumno','materias.nombre as nom_materia')
                    ->where('asesorias.id_docente',$alumno)
                    ->where('asesorias.status','Terminada')
                    ->where('asesorias.state',1)
                    ->get();
            return response()->json($asesoria);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getAsesoriasCanceladas(Request $request)
    {
        $tipo_usuario = $request->tipo;
        $alumno = $request->alumno;
        if($tipo_usuario == "Alumno"){
            $asesoria = DB::table('asesorias')
                    ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                    ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                    ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia')
                    ->where('asesorias.id_alumno',$alumno)
                    ->where('asesorias.status','Cancelada')
                    ->where('asesorias.state',1)
                    ->get();
            return response()->json($asesoria);
        }else{
            $asesoria =  DB::table('asesorias')
                    ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                    ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                    ->select('asesorias.*','alumnos.nombre as nom_alumno','materias.nombre as nom_materia')
                    ->where('asesorias.id_docente',$alumno)
                    ->where('asesorias.status','Cancelada')
                    ->where('asesorias.state',1)
                    ->get();
            return response()->json($asesoria);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getSolicitudesAlumno(Request $request)
    {
        $tipo_usuario = $request->tipo;
        $usuario = $request->usuario;
        if($tipo_usuario == "Docente"){
            $solicitud = DB::table('solicitud_alumnos')
                    ->where('id_docente',$usuario)
                    ->where('state',1)
                    ->get();
            return response()->json($solicitud);
        }else{
            $solicitud = DB::table('solicitud_alumnos')
                    ->where('id_alumno',$usuario)
                    ->where('state',1)
                    ->get();
            return response()->json($solicitud);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getSolicitudesDocente(Request $request)
    {
        $tipo_usuario = $request->tipo;
        $usuario = $request->usuario;
        if($tipo_usuario == "Docente"){
            $solicitud = DB::table('solicitud_docentes')
                    ->where('id_docente',$usuario)
                    ->where('state',1)
                    ->get();
            return response()->json($solicitud);
        }else{
            $solicitud = DB::table('solicitud_docentes')
                    ->where('id_alumno',$usuario)
                    ->where('state',1)
                    ->get();
            return response()->json($solicitud);
        }
    }

    public function solicitudAlumno(Request $request){
        $solicitud = new SolicitudAlumno();
        $solicitud->status = "pendiente";
        $solicitud->fechaSolicitud = date("y").'/'.date("m").'/'.date("d");
        $solicitud->tema = $request->tema;
        $solicitud->unidad = $request->unidad;
        $solicitud->situacion_academica = $request->situacion;
        $solicitud->id_docente = $request->docente;
        $solicitud->id_materia = $request->materia;
        $solicitud->id_alumno = $request->alumno;

        $solicitud->save();
        
        return response()->json(array ($solicitud));
    }

    public function solicituDocente(Request $request){
        $solicitar = new SolicitudDocente();
        $solicitar->status = "Pendiente";
        $solicitar->fechaSolicitud = date("y").'/'.date("m").'/'.date("d");
        $solicitar->fecha_realizacion = $request->fecha_realizacion;
        $solicitar->fecha_terminacion = $request->fecha_terminacion;
        $solicitar->lugar = $request->lugar;
        $solicitar->tema = $request->tema;
        $solicitar->unidad = $request->unidad;
        $solicitar->situacion_academica = $request->situacion;
        $solicitar->id_docente = $request->docente;
        $solicitar->id_materia = $request->materia;
        $solicitar->id_alumno = $request->alumno;
        $solicitar->save();

        return response()->json(array ($solicitar));
    }

    public function AceptarSolicitud(Request $request){

        $solicitud = SolicitudDocente::whereId($request->id)->firstOrFail();
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

        return response()->json(array ($solicitud));
    }

    public function CancelarSolicitud(Request $request){
        $id = $request->id;
        $solicitud = SolicitudAlumno::whereId($id)->firstOrFail();
        $solicitud->state = 0;
        $solicitud->save();

        return response()->json(array ($solicitud));
    }

    public function CancelarSolicitudDocente(Request $request){
        $id = $request->id;
        $solicitud = SolicitudDocente::whereId($id)->firstOrFail();
        $solicitud->state = 0;
        $solicitud->save();

        return response()->json(array ($solicitud));
    }

    public function CancelarAsesoria(Request $request){
        $id = $request->id;
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Cancelada";
        $asesoria->save();

        return response()->json(array ($asesoria));
    }

    public function TerminarAsesoria(Request $request){
        $id = $request->id;
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->status = "Terminada";
        $asesoria->save();

        return response()->json(array ($asesoria));
    }

    public function EditarAsesoria(Request $request){
        $id = $request->id;
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->tema = $request->tema;
        $asesoria->save();

        return response()->json(array ($asesoria));
    }

    public function EditarAsesoriaDocente(Request $request){
        $id = $request->id;
        $asesoria = Asesoria::whereId($id)->firstOrFail();
        $asesoria->fechaRealizacion = $request->fechaRealizacion;
        $asesoria->fechaTerminacion = $request->fechaTerminacion;
        $asesoria->tema = $request->tema;
        $asesoria->save();

        return response()->json(array ($asesoria));
    }

    public function AceptarSolicitudDocente(Request $request){

        $solicitud = SolicitudAlumno::whereId($request->id)->firstOrFail();
        $solicitud->status = "Aceptada";
        $solicitud->save();

        $asesoria = new Asesoria();
        $asesoria->status = "Aceptada";
        $asesoria->fechaSolicitud = $solicitud->fechaSolicitud;
        $asesoria->fechaRealizacion = $request->fecha_realizacion;
        $asesoria->fechaTerminacion = $request->fecha_terminacion;
        $asesoria->lugar = $request->lugar;
        $asesoria->unidad = $solicitud->unidad;
        $asesoria->tema = $solicitud->tema;
        $asesoria->id_docente = $solicitud->id_docente;
        $asesoria->id_alumno = $solicitud->id_alumno;
        $asesoria->id_materia = $solicitud->id_materia;
        $asesoria->save();

        return response()->json(array ($solicitud));
    }
}
