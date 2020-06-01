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
Route::post('editar/alumno','AlumnosController@edit')->name('editStudent');
Route::post('buscar/alumno','AlumnosController@show')->name('searchStudent');

Route::get('/agregar/docente','DocentesController@create');
Route::post('agregar/docente','DocentesController@store')->name('addDocente');
Route::post('agregar/excel/docente','DocentesController@import')->name('addTeacherExcel');
Route::post('eliminar/docente','DocentesController@delete')->name('deleteTeacher');
Route::post('editar/docente','DocentesController@edit')->name('editTeacher');
Route::post('buscar/docente','DocentesController@show')->name('buscarDocente');

Route::get('/agregar/coordinador','CoordiController@create');
Route::post('agregar/coordinador','CoordiController@store')->name('addCoordi');
Route::post('eliminar/coordinador','CoordiController@delete')->name('deleteCoordi');
Route::post('editar/coordinador','CoordiController@edit')->name('editCoordi');

Route::get('/reportes/admin','HomeController@Reportes');
Route::post('generar/reportes/admin','HomeController@generarPDF')->name('reporte.pdf');
Route::post('buscar/reporte','HomeController@Buscar')->name('BuscarReporte');

Route::get('/agregar/materia','MateriasController@index');
Route::post('agregar/materia','MateriasController@store')->name('addMateria');
Route::post('agregar/excel/materia','MateriasController@import')->name('addSubjectsExcel');
Route::post('eliminar/materia','MateriasController@delete')->name('deleteSubject');
Route::post('editar/materia','MateriasController@edit')->name('editarMateria');
Route::post('buscar/materia','MateriasController@show')->name('buscarMateria');

Route::get('/agregar/carrera','CarrerasController@index');
Route::post('agregar/carrera','CarrerasController@store')->name('addCarrera');
Route::post('eliminar/carrera','CarrerasController@delete')->name('deleteCarrera');
Route::post('buscar/carrera','CarrerasController@edit')->name('editCarrera');

Route::get('/alumno','AlumnosController@index');
Route::get('/alumno/materias','AlumnosController@lista_Materias');
Route::get('/alumno/solicitar/asesoria/{id_materia?}/{id_docente?}','AlumnosController@solicitar');
Route::post('alumno/solicitar/asesoria/{id_materia?}/{id_docente?}','AlumnosController@hacer_solicitud')->name('realizarSolictud');
Route::get('/asesorias/alumno','AlumnosController@solicitudes');
Route::post('cancelar/solicitud/alumno','AlumnosController@cancelar')->name('cancel');
Route::post('aceptar/solicitud/alumno','AlumnosController@aceptar')->name('aceptarSolicitud');
Route::post('cancelar/asesoria/alumno','AlumnosController@cancelarAsesoria')->name('cancelAsesoria');
Route::get('/alumno/docentes','AlumnosController@lista_docentes');
Route::post('alumnos/actualizar/asesoria','AlumnosController@ActualizarAsesoria')->name('actualizarAsesoria');
Route::post('alumnos/terminar/asesoria','AlumnosController@TerminarAsesoria')->name('TerminarAsesoria');

Route::get('/alumnos/perfil','AlumnosController@Perfil')->name('perfil');
Route::post('alumnos/perfil','AlumnosController@AgregarImagen')->name('addImg');

Route::get('/docentes/perfil','DocentesController@Perfil');
Route::post('docentes/perfil','DocentesController@AgregarImagen')->name('addImgDocente');

Route::get('/coordinador/perfil','CoordiController@Perfil');
Route::post('coordinador/perfil','CoordiController@AgregarImagen')->name('addImgCoordi');

Route::get('/docente','DocentesController@index');
Route::get('/docente/asesorias','DocentesController@solicitudes');
Route::post('docente/confirmar','DocentesController@confirmar')->name('confirmar');
Route::get('/docente/materias','DocentesController@Materias');
Route::get('/docente/solicitar/asesoria/{id_materia?}/{id_docente?}','DocentesController@Solicitar');
Route::post('docente/buscar/alumno','DocentesController@buscar')->name('buscarAlumno');
Route::get('/docente/buscar/alumno','DocentesController@buscar');
Route::post('cancelar/solicitud/docente','DocentesController@cancelar')->name('cancelDocente');
Route::post('docente/cancelar/asesoria','DocentesController@cancelarAsesoria')->name('cancelAsesoriaDocente');
Route::post('docente/actualizar/asesoria','DocentesController@ActualizarAsesoria')->name('actualizarAsesoriaDocente');
Route::post('docente/terminar/asesoria','DocentesController@TerminarAsesoria')->name('TerminarAsesoriaDocente');
Route::get('docente/eliminar/alumno-agregado/{get_materia?}/{num_control?}','DocentesController@EliminarAlumnoAgregado')->name('borrarAlumnoAgregado');

Route::post('docente/alumno/agregar','DocentesController@AgregarAlumnos')->name('Anexar');
Route::post('docente/solicitar','DocentesController@RealizarSolicitud')->name('RealizarSolicitud');

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('mail/send', 'AlumnosController@EnviarEmail');

//Rutas del API
Route::get('materias','ApiController@getMaterias');
Route::get('materias-docente','ApiController@getMateriasDocente');
Route::get('docentes','ApiController@getDocentes');
Route::get('lista-docentes','ApiController@Docentes');
Route::get('solicitar','ApiController@solicitudAlumno');
Route::get('solicitar-docente','ApiController@solicituDocente');
Route::get('alumnos','ApiController@getAlumnos');
Route::get('asesorias','ApiController@getAsesorias');
Route::get('asesorias-terminadas','ApiController@getAsesoriasTerminadas');
Route::get('asesorias-canceladas','ApiController@getAsesoriasCanceladas');
Route::get('solicitud','ApiController@getSolicitudesAlumno');
Route::get('solicitud-recibida','ApiController@getSolicitudesDocente');
Route::get('aceptar-solicitud','ApiController@AceptarSolicitud');
Route::get('aceptar-solicitud-docente','ApiController@AceptarSolicitudDocente');
Route::get('cancelar-solicitud','ApiController@CancelarSolicitud');
Route::get('cancelar-solicitud-docente','ApiController@CancelarSolicitudDocente');
Route::get('cancelar-asesoria','ApiController@CancelarAsesoria');
Route::get('terminar-asesoria','ApiController@TerminarAsesoria');
Route::get('editar-asesoria','ApiController@EditarAsesoria');
Route::get('editar-asesoria-docente','ApiController@EditarAsesoriaDocente');