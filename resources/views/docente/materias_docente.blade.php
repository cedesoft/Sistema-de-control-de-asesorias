@extends('docente/contenido_docente')
@section('materias')
<div><br>
    <div align="center">
        <h1>Materias</h1>
    </div><br>
</div>
<div class="row m-o justify-content-center align-items-center ">
    <div class="container">
        <div class=" row m-o d-flex justify-content-center">
            <select class="form-control " style="width: 20rem;">
                <option>Carrera</option>
            </select>
            <div class="form-group col-md-6">
                <input class="form-control" type="text" placeholder="Buscar Materia" aria-label="Search">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">
                    Buscar </button>
            </div>
        </div>
    </div>
    <div class="card w-75">
        <div class="card-body">
            <h5 class="card-title">Nombre de la Materia</h5>
            <p class="card-text">Semestre en que se imparte</p>
            <p class="card-text">Mas detalles aqui</p>
            <div align="right"><a href="#" class="btn btn-success">Solicitar Asesoría</a></div>
        </div>
    </div>
</div>

@endsection