@extends('docente/contenido_docente')
@section('solicitud')
<h2></h2>
<form action="{{ route('RealizarSolicitud') }}" method="POST">
    <div id="formulario" class="img">
        <h2><b>Solicitud de Asesoria</b></h2>
        <div class="form-group">
            <label id="l" for="materia"><b>Materia</b></label>
            <input type="text" class="form-control" id="materia" name="materia" value="{{ $materia }}" required>
        </div>
        <div class="form-group">
            <label id="l" for="unidad"><b>Unidad</b></label>
            <select class="form-control" id="unidad" name="unidad">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label id="l" for="situacion_academica"><b>Situacion academica</b></label>
            <select class="form-control" id="situacion_academica" name="situacion_academica">
                <option>El estudiante ha reprobado la unidad</option>
                <option>El docente la considero necesaria</option>
                <option>El estudiante la solicito por su cuenta</option>
            </select>
        </div>
        <div class="form-group ">
            <label id="l" for="fecha_realizacion"><b>Fecha de inicio</b></label>
            <input type="date" class="form-control" id="fecha_realizacion" name="fecha_realizacion" required>
        </div>
        <div class="form-group ">
            <label id="l" for="fecha_terminacion"><b>Fecha de fin</b></label>
            <input type="date" class="form-control" id="fecha_terminacion" name="fecha_terminacion" required>
        </div>
        <div class="form-group ">
            <label id="l" for="lugar"><b>Lugar</b></label>
            <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar de la asesoria" required>
        </div>
        <div class="form-group ">
            <label id="l" for="tema"><b>Tema</b></label>
            <textarea name="tema" id="tema" cols="30" rows="10" placeholder="Ingresa detalles del tema"
                required></textarea>
        </div>

    </div>
    <br>

    @if ($agregados->isEmpty())
    <div class="container">
        <div class="alert alert-primary col-lg-12" role="alert">
            Agregar alumnos
        </div>
    </div>
    @else
    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>No. Control</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>
                <div class="d-none">{!! $contador = 0 !!}</div>
                @foreach ($agregados as $item)
                <div class="d-none">{!! $contador++ !!}</div>
                <tr>
                    <td>{!! $item->num_control !!} <input type="text" name="{!! $contador !!}" id="" class="d-none"
                            value="{!! $item->num_control !!}"></td>
                    <td>{!! $item->nombre !!} <input type="text" name="num_control" id="" class="d-none"> </td>
                    <td>{!! $item->id_carrera !!} <input type="text" name="num_control" id="" class="d-none"> </td>
                    <td>
                        <form action="{{ route('borrarAlumnoAgregado') }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="text" class="d-none" name="num_control" id="num_control" value="{!! $item->num_control !!}">
                            <input type="text" class="d-none" id="materia" name="materia" value="{{ $materia }}">
                            <a href="{{action('DocentesController@EliminarAlumnoAgregado', [$materia, $item->num_control])}}" class="btn btn-danger">Eliminar</a>
                        </form>
                    </td>
                </tr>
                @endforeach
                <input class="d-none" type="number" name="contador" id="contador" value="{!! $contador !!}">
            </tbody>
        </table>
    </div>
    @endif

    <div class="container">
        <a href="{{url('docente/materias')}}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">Solicitar</button>
    </div>
</form>
<br>

<div class="container">
    <form action="{{ route('buscarAlumno') }}" method="POST">
        {!! csrf_field() !!}
        <div class="d-flex justify-content-center">
            <div class="form-group col-md-8">
                <input name="id" class="form-control" type="text" placeholder="No. Control" aria-label="Search">
                <input type="text" class="d-none" id="materia" name="materia" value="{{ $materia }}">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>No. Control</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>
                @if ($alumnos == 0)

                @else
                @if ($alumno->isEmpty())

                @else
                @foreach ($alumno as $item)
                <tr>
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->nombre !!}</td>
                    <td>{!! $item->id_carrera !!}</td>
                    <td>
                        <form action="{{ route('Anexar') }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="text" class="d-none" name="num_control" id="num_control" value="{!! $item->id !!}">
                            <input type="text" class="d-none" id="materia" name="materia" value="{{ $materia }}">
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
                @endif
            </tbody>
        </table>
    </div>
</div>
<br><br><br>
@endsection