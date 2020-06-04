@extends('alumno/contenido_alumno')
@section('solicitar')
<h2></h2>
<div>
    <form id="formulario" class="img" action="{{ route('realizarSolictud') }}" method="POST"
        enctype="multipart/form-data">
        {!! csrf_field() !!}
        <h2><b>Solicitar de Asesoria</b></h2>

        <input type="text" class="d-none" id="alumno" name="alumno" value="{!! $alumno->id !!}">

        <div class="form-group ">
            <label id="l" for="docente"><b>Docente</b></label>
            <input type="text" class="d-none" id="docente" name="docente" placeholder="Nombre docente"
                value="{!! $id_docente !!}">
            <input type="text" class="form-control" id="" name="" value="{!! $docente->nombre !!}" disabled>
        </div>
        @if ($id_materia != "null")
        <div class="form-group">
            <label id="l" for="materia"><b>Materia</b></label>
            <input type="text" class="form-control" id="" name="" placeholder="Materia"
                value="{!! $materia->nombre !!}" disabled>
            <input type="text" name="materia" id="materia" class="d-none" value="{!! $id_materia !!}">
        </div>
        @else
        <div class="form-group">
            <label id="l" for="materia"><b>Materias</b></label>
            <select class="form-control" id="materia" name="materia">
                @foreach ($materias as $item)
                <option value="{!! $item->id !!}">{!! $item->nombre !!}</option>
                @endforeach
            </select>
        </div>
        @endif

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
            <label id="l" for="situacion"><b>Situacion academica</b></label>
            <select class="form-control" id="situacion" name="situacion">
                <option>El estudiante ha reprobado la unidad</option>
                <option>El docente la considero necesaria</option>
                <option>El estudiante la solicito por su cuenta</option>
            </select>
        </div>
        <div class="form-group ">
            <label id="l" for="tema"><b>Tema</b></label>
            <textarea name="tema" id="tema" cols="30" rows="10" placeholder="Ingresa detalles del tema"></textarea>
        </div>
        <div id="b">
            <br>
            <a href="" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Solicitar</button>
        </div>

    </form>
    <br>
</div>
<br><br>
@endsection