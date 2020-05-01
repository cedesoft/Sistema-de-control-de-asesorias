@extends('alumno/contenido_alumno')
@section('lista_docentes')
<div><br>
    <div align="center">
        <h1>Docentes</h1>
    </div><br>
</div>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="form-group col-md-8">
            <input class="form-control" type="text" placeholder="Buscar Docente" aria-label="Search">
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">
                Buscar </button>
        </div>
    </div>

    @foreach ($docentes as $docente)
    <div class="card mb-3">
        <h5 class="card-header">{!! $docente->nombre !!}</h5>
        <div class="card-body">
            <h5 class="card-title">Docente de {!! $docente->id_carrera !!}</h5>
            <label for="exampleFormControlSelect1" class="card-text">Materias que imparte</label>
            <select class="form-control" id="exampleFormControlSelect1">
                @foreach ($materias as $item)
                    @if ($item->id_docente == $docente->id)
                        <option value="{!! $item->id !!}">{!! $item->nom_materia !!}</option>
                    @endif
                @endforeach
            </select>
            <a href="{{action('AlumnosController@solicitar', ["null", $docente->id])}}" class="btn btn-success">Solicitar Asesoría</a>
        </div>
    </div>
    @endforeach

</div><br><br><br>
@endsection