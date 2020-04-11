<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/alumno', function () {
    return view('admin/agregar_alumno_admin');
});

Route::get('/carrera', function(){
    return view('admin/agregar_carrera_admin');
});

Route::get('/docente', function(){
    return view('admin/agregar_docente_admin');
});

Route::get('/materias', function(){
    return view('admin/agregar_materias_admin');
});

Route::get('/reportes', function(){
    return view('admin/reportes_admin');
});

Route::get('/alumno/coordinador', function(){
    return view('coordinador/agregar_alumnos_coordi');
});

Route::get('/docente/coordinador', function(){
    return view('coordinador/agregar_docentes_coordi');
});

Route::get('/materia/coordinador', function(){
    return view('coordinador/agregar_materias_coordi');
});

Route::get('/reporte/coordinador', function(){
    return view('coordinador/reportes_coordi');
});

Route::get('/asesorias/alumno', function(){
    return view('alumno/asesorias_alumno');
});

Route::get('/solicitar/alumno', function(){
    return view('alumno/solicitar_asesorias');
});

Route::get('/materias/alumno', function(){
    return view('alumno/lista_materias');
});

Route::get('/docentes/alumno', function(){
    return view('alumno/lista_docentes');
});

Route::get('/alumno', function(){
    return view('alumno/inicio_alumno');
});

Route::get('/docente/materias', function(){
    return view('docente/materias_docente');
});

Route::get('/docente/solicitud', function(){
    return view('docente/solicitud_docente');
});

Route::get('/docente/asesorias', function(){
    return view('docente/asesorias_docente');
});

Route::get('/docente', function(){
    return view('docente/inicio_docente');
});