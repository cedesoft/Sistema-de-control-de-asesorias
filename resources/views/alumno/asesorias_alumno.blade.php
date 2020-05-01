@extends('alumno/contenido_alumno')
@section('asesorias_alumno')

<br>
<div class="container">
    <div>
        <select class="form-control form-control-lg" style="width: 25rem;">
            <option>Completadas recientemente</option>
            <option>Pendientes</option>
            <option>Completadas</option>
            <option>Canceladas</option>
        </select>
    </div>
    <br>
    <div>
        <section>
            <div class="card-deck" style="width: 18rem;">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Materia</h5>
                        <p class="card-text">Docente</p>
                        <p class="card-text">Tema</p>
                        <p class="card-text">Estado</p>
                        <p class="card-text">Fecha</p>

                        <div align="right" class="card-body">
                            <a href="#modal1">Detalles</a>
                            <div id="modal1" class="modalmask">
                                <div class="modalbox movedown">
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div data-spy="scroll" data-target="#navbar-example3" data-offset="0">
                                        <form id="formulario" class="img">
                                            <h2><b>Detalles de Asesoría</b></h2>
                                            <div class="form-group ">
                                                <label id="l" for="exampleInputEmail1"><b>Impartida por:</b></label>
                                            </div>
                                            <div class="form-group">
                                                <label id="l" for="exampleFormControlSelect1"><b>Fecha de
                                                        solicitud:</b></label>
                                            </div>
                                            <div class="form-group">
                                                <label id="l" for="exampleFormControlSelect1"><b>Fecha de
                                                        realización:</b></label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="Otra fecha">
                                            </div>
                                            <div class="form-group">
                                                <label id="l" for="exampleFormControlSelect1"><b>Hora:</b></label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="00:00 hrs">
                                            </div>
                                            <div class="form-group">
                                                <label id="l" for="exampleFormControlSelect1"><b>Materia: </b></label>
                                            </div>
                                            <div class="form-group">
                                                <label id="l" for="exampleFormControlSelect1"><b>Unidad de la Materia:
                                                    </b></label>
                                            </div>
                                            <div class="form-group ">
                                                <label id="l" for="exampleInputEmail1"><b>Tema</b></label>
                                                <textarea name="" id="" cols="30" rows="5"
                                                    placeholder="Ingresa detalles del tema"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="card-deck" style="width: 18rem;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Materia</h5>
                        <p class="card-text">Docente</p>
                        <p class="card-text">Tema</p>
                        <p class="card-text">Estado</p>
                        <p class="card-text">Fecha</p>
                        <div align="right" class="card-body">
                            <ul class="list-group list-group-flush">
                                <button type="button" class="btn btn-success">Terminar</button>
                            </ul>
                            <a href="#" class="card-link">Cancelar</a>
                            <a href="#modal1">Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                Featured 2
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar materia</h5>
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
    <br><br><br>
</div>
<script>
    $(document).on("click", ".open-Modal", function () {
        var id = $(this).data('id');
        var nombre = $(this).data('name');
        $(".modal-body #id_text").text(nombre);
        $(".modal-footer #id").val(id);
    });
</script>
@endsection