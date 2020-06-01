<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Asesoria;
use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin', 'docente','coordinador']);
        $nombre = $request->user()->name;
        
        if($request->user()->hasRole('docente')){
            $docente = DB::table('docentes')->where('nombre',$nombre)->first();
            return view('docente.inicio_docente',compact('docente'));
        }else if($request->user()->hasRole('user')){
            $alumno = DB::table('alumnos')->where('nombre',$nombre)->first();
            return view('alumno.inicio_alumno',compact('alumno'));
        }else{
            return redirect(action('DocentesController@create'));
        }
    }

    public function Reportes(Request $request){
        $request->user()->authorizeRoles(['admin','coordinador']);
        $buscar = false;
        $nombre_c = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre_c)->first();
        $carrera = DB::table('carreras')->get();
        return view('admin.reportes_admin', compact('coordi','buscar','carrera'));
    }
    
    public static function Buscar(Request $request){
        $request->user()->authorizeRoles(['admin','coordinador']);
        $carrera = DB::table('carreras')->where('state',1)->get();
        $buscar = true;
        $nombre_c = $request->user()->name;
        $coordi = DB::table('coordinador')->where('nombre',$nombre_c)->first();

        $docente = $request->input('docente');
        $alumno = $request->input('alumno');
        $carreras = $request->input('carrera');
        $inicio = $request->input('fecha_inicio');
        $fin = $request->input('fecha_final');

        if(!empty($inicio) && !empty($fin)){
            if(!empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('docentes.id_carrera',$carreras)
                                ->where('alumnos.id',$alumno)
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();
                
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
    
            }else if(!empty($docente) && empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('docentes.id_carrera',$carreras)
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();
    
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
            }else if(empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('alumnos.id',$alumno)
                                ->where('docentes.id_carrera',$carreras)
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();
                
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
            }else{
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.id_carrera',$carreras)
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();
    
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
            }
        }else{
            if(!empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('docentes.id_carrera',$carreras)
                                ->where('alumnos.id',$alumno)
                                ->get();
                
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
    
            }else if(!empty($docente) && empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('docentes.id_carrera',$carreras)
                                ->get();
    
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
            }else if(empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('alumnos.id',$alumno)
                                ->where('docentes.id_carrera',$carreras)
                                ->get();
                
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
            }else{
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.id_carrera',$carreras)
                                ->get();
    
                return view('admin.reportes_admin', compact('coordi','asesorias','buscar','docente','alumno','carrera','carreras','inicio','fin'));
            }
        }
        
    }

    public static function generarPDF(Request $request){
        $docente = $request->input('docente');
        $alumno = $request->input('alumno');
        $carreras = $request->input('carrera');
        $inicio = $request->input('fecha_inicio');
        $fin = $request->input('fecha_final');
        if(!empty($inicio) && !empty($fin)){
            if(!empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('alumnos.id',$alumno)
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();

                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }else if(!empty($docente) && empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();

                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }else if(empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->where('alumnos.id',$alumno)
                                ->get();
                
                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }else{
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.id_carrera',$carreras)
                                ->where('asesorias.fechaTerminacion','>=',$inicio)
                                ->where('asesorias.fechaTerminacion','<=',$fin)
                                ->get();
                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }
        }else{
            if(!empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->where('alumnos.id',$alumno)
                                ->get();

                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }else if(!empty($docente) && empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.nombre','like','%'.$docente.'%')
                                ->get();

                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }else if(empty($docente) && !empty($alumno)){
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('alumnos.id',$alumno)
                                ->get();
                
                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }else{
                $asesorias = DB::table('asesorias')
                                ->leftjoin('docentes','asesorias.id_docente','=','docentes.id')
                                ->leftjoin('materias','asesorias.id_materia','=','materias.id')
                                ->leftjoin('alumnos','asesorias.id_alumno','=','alumnos.id')
                                ->select('asesorias.*','docentes.nombre as nom_docente','materias.nombre as nom_materia','alumnos.nombre as nom_alumno')
                                ->where('asesorias.state','=','1')
                                ->where('docentes.id_carrera',$carreras)
                                ->get();
                $pdf = PDF::loadView('admin.reporte', compact('asesorias'));
                return $pdf->download('reporte.pdf');
            }
        }
    }
}
