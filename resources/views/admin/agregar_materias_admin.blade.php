@extends('admin/contenido_admin')
@section('agregar_materias')
<h2></h2>

<form id="formulario" class="img" method="POST" action="{{ route('addMateria') }}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <h2><b>Materias</b></h2>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label id="l" for="name"><b>Nombre</b></label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="form-group col-md-4">
            <label id="l" for="2"><b>Clave</b></label>
            <input type="text" class="form-control" id="clave" name="clave" placeholder="Clave" required>
        </div>
    </div>
    <div class="form-group ">
        <label id="l" for="3"><b>Creditos</b></label>
        <input type="text" class="form-control" id="creditos" name="creditos" aria-describedby="emailHelp"
            placeholder="Creditos" required>
    </div>
    <div class="form-group">
        <label id="l" for="4"><b>Horas</b></label>
        <input type="text" class="form-control" id="horas" name="horas" placeholder="Horas por semana" required>
    </div>

    <div id="b">
        <br>
        <button type="submit" class="btn btn-primary">
            Agregar<i style='font-size:18px' class="material-icons">&#xe7fe;</i></button>
    </div>
</form>
<br>

<form class="container" action="{{ route('addSubjectsExcel') }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="validatedCustomFile" name="excel" required>
        <label class="custom-file-label" for="validatedCustomFile"> Buscar Excel
            <div class="invalid-feedback">Example invalid custom file feedback</div>
    </div>
    <button type="submit" class="btn btn-success">Cargar Excel</button>
</form>
<br>

@if (session('success'))
<div class="container alert alert-success">
    {{ session('success') }}
</div>
@endif

<br>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="form-group col-md-8">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </div>
        <div class="form-group col-md-4">
            <a href="#" class="btn btn-primary btn-lg">
                <span class="glyphicon glyphicon-search"></span> Buscar
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>Horas</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @if($materias->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Aun no hay ningun registro.
                </div>
                @else
                @foreach ($materias as $materia)
                <tr>
                    <td>{!! $materia->id !!}</td>
                    <td>{!! $materia->nombre !!}</td>
                    <td>{!! $materia->creditos !!}</td>
                    <td>{!! $materia->horas !!}</td>
                    <td><a href="" class="btn btn-warning">Editar</a></td>
                    <td><a href="" class="btn btn-danger open-Modal" data-id="{!! $materia->id !!}"
                            data-name="{!! $materia->nombre !!}" data-toggle="modal"
                            data-target="#exampleModalCenter">Eliminar</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar la materia de <strong id="id_text"></strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('deleteSubject') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="text" class="d-none" id="id" name="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!--End Modal -->

<script>
    $(document).on("click", ".open-Modal", function () {
        var id = $(this).data('id');
        var nombre = $(this).data('name');
        $(".modal-body #id_text").text(nombre);
        $(".modal-footer #id").val(id);
    });
</script>

@endsection