@extends('docente/contenido_docente')
@section('asesorias')
<div><br></div>
<div class="container">
    <select class="form-control form-control-lg" style="width: 25rem;">
        <option>Completadas recientemente</option>
        <option>Pendientes</option>
        <option>Completadas</option>
        <option>Canceladas</option>
    </select>
</div>
<div><br></div>
<div class="container">
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
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <div>
        <section>
            <div class="alert alert-primary" role="alert">
                <h1 align="center">Solicitudes de Asesorías</h1>
            </div>
            <div class="row m-o justify-content-center align-items-center ">
                <div class="card w-75">

                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="asesoriaDRecibida.html">Recibidas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="asesoriaDEnviadas.html">Enviadas</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <p align="right" class="card-text">Fecha</p>
                        <h5 class="card-title">Solicitud de "Alumno"</h5>
                        <p class="card-text">Para la unidad "" de la materia "".</p>
                        <div class="alert alert-light" role="alert">
                            Es necesario agendar la asesoría
                        </div>
                        <div align="right"> <a href="#" class="btn btn-success">Confirmar</a></div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection