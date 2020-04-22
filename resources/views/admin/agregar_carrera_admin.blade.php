@extends('admin/contenido_admin')
@section('agregar_carrera')

<h2></h2>
<div>
    <form id="formulario" class="img" method="POST" action="{{ route('addCarrera') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <h2><b>Carreras</b></h2>
        <div class="form-row">
            <div class="form-group">
                <label id="l" for="clave"><b>Clave</b></label>
                <input type="text" class="form-control" id="clave" name="clave" placeholder="Calve">
            </div>
            <div class="form-group">
                <label id="l" for="nombre"><b>Nombre</b></label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div id="b">
                <br>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </form>
</div>
<br>

<br>
@if (session('success'))
<div class="container alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @if($carreras->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Aun no hay ningun registro.
                </div>
                @else
                    @foreach ($carreras as $carrera)
                    <tr>
                        <td>{!! $carrera->id !!}</td>
                        <td>{!! $carrera->nombre !!}</td>
                        <td><a href="" class="btn btn-warning">Editar</a></td>
                        <td><a href="" class="btn btn-danger open-Modal" data-id="{!! $carrera->id !!}"
                                data-name="{!! $carrera->nombre !!}" data-toggle="modal"
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
                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar la carrera de <strong id="id_text"></strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('deleteCarrera') }}" method="POST" enctype="multipart/form-data">
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