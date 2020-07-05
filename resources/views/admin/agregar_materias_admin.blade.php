@extends('admin/contenido_admin')
@section('agregar_materias')
<h2></h2>

<form id="formulario" class="img" method="POST" action="{{ route('addMateria') }}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <h2><b>Materias</b></h2>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label id="l" for="nombre"><b>Nombre</b></label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="form-group col-md-4">
            <label id="l" for="clave"><b>Clave</b></label>
            <input type="text" class="form-control" id="clave" name="clave" placeholder="Clave" required>
        </div>
    </div>
    <div class="form-group ">
        <label id="l" for="creditos"><b>Creditos</b></label>
        <input type="text" class="form-control" id="creditos" name="creditos" placeholder="Creditos" required>
    </div>
    <div class="form-group">
        <label id="l" for="horas"><b>Horas</b></label>
        <input type="text" class="form-control" id="horas" name="horas" placeholder="Horas por semana" required>
    </div>

    <div class="form-group">
        <label id="l" for="semestre"><b>Semestre</b></label>
        <input type="text" class="form-control" id="semestre" name="semestre" placeholder="Semestre en que se imparte"
            required>
    </div>

    <div class="form-group">
        <label id="l" for="docente"><b>Docente</b></label>
        <select class="form-control" id="docente" name="docente">
            @foreach ($docentes as $item)
            <option value="{!! $item->id !!}"> {!! $item->nombre !!} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label id="l" for="carrera"><b>Carrera</b></label>
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
<div class="container">
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
</div>

@endif

<br>

<div class="container">
    <form action="{{ route('buscarMateria') }}" method="POST">
        {!! csrf_field() !!}
        <div class="d-flex justify-content-center">
            <div class="form-group col-md-8">
                <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" id="buscar"
                    name="buscar">
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
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>Horas</th>
                    <th>Semestre</th>
                    <th>Carrera</th>
                    <th>Docente</th>
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
                    <td>{!! $materia->semestre !!}</td>
                    <td>{!! $materia->id_carrera !!}</td>
                    <td>{!! $materia->id_docente !!}</td>
                    <td><button class="btn btn-warning open-Editar" data-id="{!! $materia->id !!}"
                            data-nombre="{!! $materia->nombre !!}" data-creditos="{!! $materia->creditos !!}"
                            data-horas="{!! $materia->horas !!}" data-semestre="{!! $materia->semestre !!}"
                            data-toggle="modal" data-target="#editarModal">Editar</button></td>
                    <td><button class="btn btn-danger open-Modal" data-id="{!! $materia->id !!}"
                            data-name="{!! $materia->nombre !!}" data-toggle="modal"
                            data-target="#exampleModalCenter">Eliminar</button></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @if ($page)
            {{ $materias->links() }}
        @endif
        <br><br>
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
<!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('editarMateria') }}" method="POST">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"><b>Nombre</b></label>
                        <input type="text" class="form-control" id="name" name="name">
                        <input type="text" name="id_materia" id="id_materia" class="d-none">
                    </div>

                    <div class="form-group">
                        <label for="creditos"><b>Creditos</b></label>
                        <input type="creditos" class="form-control" id="creditos" name="creditos">
                    </div>

                    <div class="form-group">
                        <label for="horas"><b>Horas por semana</b></label>
                        <input type="text" class="form-control" id="horas" name="horas">
                    </div>

                    <div class="form-group">
                        <label for="semestre"><b>Semestre</b></label>
                        <input type="text" class="form-control" id="semestre" name="semestre">
                    </div>

                    <div class="form-group">
                        <label id="l" for="6"><b>Carrera</b></label>
                        <select class="form-control" id="carrera" name="carrera">
                            @foreach ($carreras as $item)
                            <option> {!! $item->id !!} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="l" for="docente"><b>Docente</b></label>
                        <select class="form-control" id="docente" name="docente">
                            @foreach ($docentes as $item)
                            <option value="{!! $item->id !!}"> {!! $item->nombre !!} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
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
    $(document).on("click", ".open-Editar", function () {
            var id = $(this).data('id');
            var nombre = $(this).data('nombre');
            var creditos = $(this).data('creditos');
            var horas = $(this).data('horas');
            var semestre = $(this).data('semestre');

            $(".modal-body #id_materia").val(id);
            $(".modal-body #name").val(nombre);
            $(".modal-body #creditos").val(creditos);
            $(".modal-body #horas").val(horas);
            $(".modal-body #semestre").val(semestre);
        });
</script>

@endsection