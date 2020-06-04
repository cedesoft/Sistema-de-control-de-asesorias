@extends('alumno/contenido_alumno')
@section('asesorias_alumno')
<br>
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab"
                aria-controls="pendientes" aria-selected="true">Pendientes</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="completadas-tab" data-toggle="tab" href="#completadas" role="tab"
                aria-controls="completadas" aria-selected="false">Completadas</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="canceladas-tab" data-toggle="tab" href="#canceladas" role="tab"
                aria-controls="canceladas" aria-selected="false">Canceladas</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
            <section class="row">
                @if ($asesorias->isEmpty())
                <div class="col-lg-12" role="alert">
                    <div class="alert alert-primary">
                        No se han realizado asesorias
                    </div>
                </div>
                @else
                @foreach ($asesorias as $item)
                <div class="mb-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{!! $item->nom_materia !!}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{!! $item->nom_docente !!}</li>
                            <li class="list-group-item">{!! $item->tema !!}</li>
                            <li class="list-group-item">{!! $item->status !!}</li>
                            <li class="list-group-item">{!! $item->fechaRealizacion !!}</li>
                        </ul>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <button type="button" class="btn btn-success open-Terminar" data-id="{!! $item->id !!}"
                                    data-name="{!! $item->nom_materia !!}" data-toggle="modal"
                                    data-target="#ModalTerminar">Terminar</button>
                            </ul>
                            <a href="" class="open-Modal card-link" data-id="{!! $item->id !!}"
                                data-name="{!! $item->nom_materia !!}" data-toggle="modal"
                                data-target="#ModalCancelar">Cancelar</a>

                            <a href="" class="card-link open-Detalles" data-id="{!! $item->id !!}"
                                data-iddocente="{!! $item->id_docente !!}" data-idalumno="{!! $item->id_alumno !!}"
                                data-idmateria="{!! $item->id_materia !!}" data-alumno="{!! $item->nom_alumno !!}"
                                data-materia="{!! $item->nom_materia !!}" data-docente="{!! $item->nom_docente !!}"
                                data-fecha=" {!! $item->fechaSolicitud !!}" data-unidad="{!! $item->unidad !!}"
                                data-fechar=" {!! $item->fechaRealizacion !!}" data-lugar={!! $item->lugar !!}
                                data-fechat=" {!! $item->fechaTerminacion !!}" data-tema="{!! $item->tema !!}"
                                data-toggle="modal" data-target="#ModalDetalles">Detalles</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </section>
        </div>

        <div class="tab-pane fade" id="completadas" role="tabpanel" aria-labelledby="completadas-tab">
            <section class="row">
                @if ($asesorias_terminadas->isEmpty())
                <div class="col-lg-12" role="alert">
                    <div class="alert alert-primary">
                        No se han realizado asesorias
                    </div>
                </div>
                @else
                @foreach ($asesorias_terminadas as $item)
                <div class="mb-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{!! $item->nom_materia !!}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{!! $item->nom_docente !!}</li>
                            <li class="list-group-item">{!! $item->tema !!}</li>
                            <li class="list-group-item">{!! $item->status !!}</li>
                            <li class="list-group-item">{!! $item->fechaRealizacion !!}</li>
                        </ul>
                        <div class="card-body">
                            <a href="" class="card-link open-Detalles" data-id="{!! $item->id !!}"
                                data-iddocente="{!! $item->id_docente !!}" data-idalumno="{!! $item->id_alumno !!}"
                                data-idmateria="{!! $item->id_materia !!}" data-alumno="{!! $item->nom_alumno !!}"
                                data-materia="{!! $item->nom_materia !!}" data-docente="{!! $item->nom_docente !!}"
                                data-fecha=" {!! $item->fechaSolicitud !!}" data-unidad="{!! $item->unidad !!}"
                                data-fechar=" {!! $item->fechaRealizacion !!}" data-lugar={!! $item->lugar !!}
                                data-fechat=" {!! $item->fechaTerminacion !!}" data-tema="{!! $item->tema !!}"
                                data-toggle="modal" data-target="#ModalDetalles">Detalles</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </section>
        </div>

        <div class="tab-pane fade" id="canceladas" role="tabpanel" aria-labelledby="canceladas-tab">
            <section class="row">
                @if ($asesorias_canceladas->isEmpty())
                <div class="col-lg-12" role="alert">
                    <div class="alert alert-primary">
                        No se han realizado asesorias
                    </div>
                </div>
                @else
                @foreach ($asesorias_canceladas as $item)
                <div class="mb-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{!! $item->nom_materia !!}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{!! $item->nom_docente !!}</li>
                            <li class="list-group-item">{!! $item->tema !!}</li>
                            <li class="list-group-item">{!! $item->status !!}</li>
                            <li class="list-group-item">{!! $item->fechaRealizacion !!}</li>
                        </ul>
                        <div class="card-body">
                            <a href="" class="card-link open-Detalles" data-id="{!! $item->id !!}"
                                data-iddocente="{!! $item->id_docente !!}" data-idalumno="{!! $item->id_alumno !!}"
                                data-idmateria="{!! $item->id_materia !!}" data-alumno="{!! $item->nom_alumno !!}"
                                data-materia="{!! $item->nom_materia !!}" data-docente="{!! $item->nom_docente !!}"
                                data-fecha=" {!! $item->fechaSolicitud !!}" data-unidad="{!! $item->unidad !!}"
                                data-fechar=" {!! $item->fechaRealizacion !!}" data-lugar={!! $item->lugar !!}
                                data-fechat=" {!! $item->fechaTerminacion !!}" data-tema="{!! $item->tema !!}"
                                data-toggle="modal" data-target="#ModalDetalles">Detalles</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </section>
        </div>
    </div>
    <br>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="ModalCancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cancelar asesoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Deseas cancelar la asesoria para la materia de <strong id="id_text"></strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('cancelAsesoria') }}" method="POST" enctype="multipart/form-data">
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
        <div class="modal fade" id="ModalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Detalles de asesoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('actualizarAsesoria') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <h2><b>Detalles de Asesoría</b></h2>
                            <div class="form-group ">
                                <label id="l" for="docente"><b>Impartida por</b></label>
                                <input type="text" class="form-control" id="docente" name="docente" disabled>
                                <input type="text" class="d-none" id="id" name="id">
                                <input type="text" class="d-none" id="id_docente" name="id_docente">
                                <input type="text" class="d-none" id="id_materia" name="id_materia">
                                <input type="text" class="d-none" id="id_alumno" name="id_alumno">
                            </div>
                            <div class="form-group">
                                <label id="l" for="fecha_solicitud"><b>Fecha de solicitud</b></label>
                                <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" disabled>
                            </div>
                            <div class="form-group">
                                <label id="l" for="fecha_realizacion"><b>Fecha de realización</b></label>
                                <input type="date" class="form-control" id="fecha_realizacion" name="fecha_realizacion"
                                    placeholder="Fecha para iniciar asesorias" disabled>
                            </div>
                            <div class="form-group">
                                <label id="l" for="fecha_terminacion"><b>Fecha de terminacion</b></label>
                                <input type="date" class="form-control" id="fecha_terminacion" value="2020/05/05"
                                    name="fecha_terminacion" placeholder="Fecha para terminar asesorias" disabled>
                            </div>
                            <div class="form-group">
                                <label id="l" for="hora"><b>Lugar</b></label>
                                <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar de asesoria" disabled>
                            </div>
                            <div class="form-group">
                                <label id="l" for="materia"><b>Materia</b></label>
                                <input type="text" class="form-control" id="materia" name="materia" disabled>
                            </div>
                            <div class="form-group">
                                <label id="l" for="unidad"><b>Unidad de la Materia</b></label>
                                <input type="text" class="form-control" id="unidad" name="unidad" disabled>
                            </div>
                            <div class="form-group ">
                                <label id="l" for="tema"><b>Tema</b></label>
                                <textarea name="tema" id="tema" cols="30" rows="5"
                                    placeholder="Ingresa detalles del tema"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
    <div>
        <section>
            <div class="alert alert-primary" role="alert">
                <h1 align="center">Solicitudes de Asesorías</h1>
            </div>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Enviadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Recibidas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if ($solicitudes->isEmpty())
                        <div class="alert alert-primary" role="alert">
                            No se han realizado solicitudes
                        </div>
                        @else
                        @foreach ($solicitudes as $item)
                        <div class="card mb-3">
                            <div class="card-header">
                                {!! $item->nom_materia !!}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{!! $item->nom_docente !!}</h5>
                                <p class="card-text">Solicitaste una asesoria para el tema de <strong>{!! $item->tema
                                        !!}</strong>
                                    que corresponde a la unidad <strong>{!! $item->unidad !!}</strong> de la materia de
                                    <strong>{!! $item->nom_materia !!}</strong>
                                </p>
                                <p>
                                    Estado: {!! $item->status !!}
                                </p>
                                <a href="" class="btn btn-danger open-Modal" data-id="{!! $item->id !!}"
                                    data-name="{!! $item->nom_materia !!}" data-toggle="modal"
                                    data-target="#exampleModalCenter">Cancelar</a>
                            </div>
                            <div class="card-footer text-muted">
                                {!! $item->fechaSolicitud !!}
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @if ($solicitudes_recibidas->isEmpty())
                        <div class="alert alert-primary" role="alert">
                            No se han recibido solicitudes
                        </div>
                        @else
                        @foreach ($solicitudes_recibidas as $item)
                        <div class="card mb-3">
                            <div class="card-header">
                                {!! $item->nom_materia !!}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{!! $item->nom_docente !!}</h5>
                                <p class="card-text">Se ha solicitado una asesoria para el tema de <strong>{!!
                                        $item->tema
                                        !!}</strong>
                                    que corresponde a la unidad <strong>{!! $item->unidad !!}</strong> de la materia de
                                    <strong>{!! $item->nom_materia !!}</strong>
                                </p>
                                <p>
                                    Estado: {!! $item->status !!}
                                </p>
                                <a href="" class="btn btn-success open-Aceptar" data-id="{!! $item->id !!}"
                                    data-name="{!! $item->nom_materia !!}" data-toggle="modal"
                                    data-target="#ModalAceptar">Aceptar</a>
                            </div>
                            <div class="card-footer text-muted">
                                {!! $item->fechaSolicitud !!}
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cancelar Solicitud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseas cancelar la solicitud para la materia de <strong id="id_text"></strong>?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('cancel') }}" method="POST" enctype="multipart/form-data">
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
    <div class="modal fade" id="ModalAceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Aceptar Solicitud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseas acepatr la solicitud para la materia de <strong id="id_text"></strong>?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('aceptarSolicitud') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="text" class="d-none" id="id" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
    <!-- Modal -->
    <div class="modal fade" id="ModalTerminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terminar Asesoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseas dar por terminada la asesoria para la materia de <strong id="id_text"></strong>?
                    Ten en cuenta que esto significa que la asesoria ya fue impartida por el docente.
                </div>
                <div class="modal-footer">
                    <form action="{{ route('TerminarAsesoria') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        Ingresa observaciones respecto a la asesoria en caso de haberlas.
                        <textarea name="observaciones" id="observaciones" cols="50" rows="5"></textarea>
                        <input type="text" class="d-none" id="id" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Terminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
    <br><br><br>
</div>
<script>
    $(document).on("click", ".open-Modal", function () {
        var id = $(this).data('id');
        var nombre = $(this).data('name');
        $(".modal-body #id_text").text(nombre);
        $(".modal-footer #id").val(id);
    });

    $(document).on("click", ".open-Aceptar", function(){
        var id = $(this).data('id');
        var nombre = $(this).data('name');
        $(".modal-body #id_text").text(nombre);
        $(".modal-footer #id").val(id);
    });

    $(document).on("click", ".open-Terminar", function () {
        var id = $(this).data('id');
        var nombre = $(this).data('name');
        $(".modal-body #id_text").text(nombre);
        $(".modal-footer #id").val(id);
    });
    $(document).on("click", ".open-Detalles", function () {
        var id = $(this).data('id');
        var id_docente = $(this).data('iddocente');
        var id_alumno = $(this).data('idalumno');
        var id_materia = $(this).data('idmateria');
        var docente = $(this).data('docente');
        var alumno = $(this).data('alumno');
        var materia = $(this).data('materia');
        var fecha = $(this).data('fecha');
        var fechar = $(this).data('fechar');
        var fechat = $(this).data('fechat');
        var tema = $(this).data('tema');
        var lugar = $(this).data('lugar');
        var unidad = $(this).data('unidad');

        $(".modal-body #id").val(id);
        $(".modal-body #docente").val(docente);
        $(".modal-body #id_docente").val(id_docente);
        $(".modal-body #fecha_solicitud").val(fecha.trim());
        $(".modal-body #fecha_realizacion").val(fechar.trim());
        $(".modal-body #fecha_terminacion").val(fechat.trim());
        $(".modal-body #tema").val(tema);
        $(".modal-body #lugar").val(lugar);
        $(".modal-body #unidad").val(unidad);
        $(".modal-body #materia").val(materia);
        $(".modal-body #id_materia").val(id_materia);
        $(".modal-body #id_alumno").val(id_alumno);
    });
</script>
@endsection