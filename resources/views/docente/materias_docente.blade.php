@extends('docente/contenido_docente')
@section('materias')
<div><br>
    <div align="center">
        <h1>Materias</h1>
    </div><br>
</div>
<div class="container">
    {{-- <div class="d-flex justify-content-center">
        <div class="form-group col-md-8">
            <input class="form-control" type="text" placeholder="Buscar Materia" aria-label="Search">
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">
                Buscar </button>
        </div>
    </div> --}}

    @foreach ($materias as $materia)
    <div class="card mb-3">
        <h5 class="card-header">{!! $materia->nombre !!}</h5>
        <div class="card-body">
            <h5 class="card-title">Docente {!! $materia->nombre_docente !!}</h5>
            <p class="card-text">Materia impartida en el semestre {!! $materia->semestre !!} de la carrera {!!
                $materia->id_carrera !!}</p>
            <a href="{{action('DocentesController@Solicitar', [$materia->id])}}"
                class="btn btn-success">Solicitar Asesoría</a>
        </div>
    </div>
    @endforeach
</div>
<br><br><br>
@endsection