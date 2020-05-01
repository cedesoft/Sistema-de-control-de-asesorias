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

Route::get('/agregar/alumno','AlumnosController@create');
Route::post('agregar/alumno','AlumnosController@store')->name('addAlumno');
Route::post('agregar/excel','AlumnosController@import')->name('addExcel');
Route::post('eliminar/alumno','AlumnosController@delete')->name('deleteStudent');

Route::get('/agregar/docente','DocentesController@create');
Route::post('agregar/docente','DocentesController@store')->name('addDocente');
Route::post('agregar/excel/docente','DocentesController@import')->name('addTeacherExcel');
Route::post('eliminar/docente','DocentesController@delete')->name('deleteTeacher');

Route::get('/agregar/materia','MateriasController@index');
Route::post('agregar/materia','MateriasController@store')->name('addMateria');
Route::post('agregar/excel/materia','MateriasController@import')->name('addSubjectsExcel');
Route::post('eliminar/materia','MateriasController@delete')->name('deleteSubject');

Route::get('/agregar/carrera','CarrerasController@index');
Route::post('agregar/carrera','CarrerasController@store')->name('addCarrera');
Route::post('eliminar/carrera','CarrerasController@delete')->name('deleteCarrera');

Route::get('/alumno','AlumnosController@index');
Route::get('/alumno/materias','AlumnosController@lista_Materias');
Route::get('/alumno/solicitar/asesoria/{id_materia?}/{id_docente?}','AlumnosController@solicitar');
Route::post('alumno/solicitar/asesoria/{id_materia?}/{id_docente?}','AlumnosController@hacer_solicitud')->name('realizarSolictud');
Route::get('/asesorias/alumno','AlumnosController@solicitudes');
Route::post('cancelar/solicitud/alumno','AlumnosController@cancelar')->name('cancel');
Route::get('/alumno/docentes','AlumnosController@lista_docentes');

Route::get('/', function(){
    return view('welcome');
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
