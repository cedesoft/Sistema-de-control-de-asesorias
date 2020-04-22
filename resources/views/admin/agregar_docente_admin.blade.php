@extends('admin/contenido_admin')
@section('agregar_docente')
<h2></h2>

<form id="formulario" class="img" method="POST" action="{{ route('addDocente') }}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <h2><b>Docentes</b></h2>

    <div class="form-group">
        <label id="l" for="name"><b>Nombre</b></label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
    </div>


    <div class="form-group ">
        <label id="l" for="3"><b>Correo</b></label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
            placeholder="Ingresa un email" required>
    </div>

    <div class="form-group">
        <label id="l" for="4"><b>Contraseña</b></label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
    </div>

    <div class="form-group">
        <label id="l" for="6"><b>Carrera</b></label>
        <select class="form-control" id="carrera" name="carrera">
            @foreach ($carreras as $item)
            <option> {!! $item->id !!} </option>
            @endforeach
        </select>
    </div>

    <div id="b">
        <br>
        <button type="submit" class="btn btn-primary">
            Agregar<i style='font-size:18px' class="material-icons">&#xe7fe;</i></button>
    </div>
</form>
<br>

<form class="container" action="{{ route('addTeacherExcel') }}" method="POST" enctype="multipart/form-data">
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
    <h2></h2>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark ">
            <tr>
                <th>No. Control</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Carrera</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @if($docentes->isEmpty())
            <div class="alert alert-warning" role="alert">
                Aun no hay ningun registro.
            </div>
            @else
            @foreach ($docentes as $docente)
            <tr>
                <td>{!! $docente->id !!}</td>
                <td>{!! $docente->nombre !!}</td>
                <td>{!! $docente->correo !!}</td>
                <td>{!! $docente->contraseña !!}</td>
                <td>{!! $docente->id_carrera !!}</td>
                <td><a href="" class="btn btn-warning">Editar</a></td>
                <td><a href="" class="btn btn-danger open-Modal" data-id="{!! $docente->id !!}" data-name="{!! $docente->nombre !!}" data-toggle="modal"
                        data-target="#exampleModalCenter">Eliminar</a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar docente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar al docente <strong id="id_text"></strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('deleteTeacher') }}" method="POST" enctype="multipart/form-data">
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
        var name = $(this).data('name');
        $(".modal-body #id_text").text(name);
        $(".modal-footer #id").val(id);
    });
</script>
<br>
<br>
@endsection