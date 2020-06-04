@extends('admin/contenido_admin')
@section('reportes_admin')
<h2></h2>
<div>
    <form id="formulario" class="img" action="{{ route('BuscarReporte') }}" method="POST">
        {!! csrf_field() !!}
        <h2><b>Reportes</b></h2>
        <div class="form-row">
            <div class="form-group">
                <label id="l" for="carrera"><b>Carrera</b></label>
            </div>
            <div class="form-group col-lg-12">
                <select class="form-control" id="carrera" name="carrera">
                    @if(Auth::user()->hasRole('admin'))
                        @foreach ($carrera as $item)
                        <option value="{!! $item->id !!}">{!! $item->nombre !!}</option>
                        @endforeach
                    @else
                    <option value="{!! $carrera_coordi->id !!}">{!! $carrera_coordi->nombre !!}</option>
                    @endif

                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label id="l" for="docente"><b>Docente</b></label>
            </div>
            <div class="form-group col-md-12">
                <input type="text" class="form-control" id="docente" name="docente" placeholder="Nombre">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label id="l" for="alumno"><b>Alumno</b></label>
            </div>
            <div class="form-group col-md-12">
                <input type="text" class="form-control" id="alumno" name="alumno" placeholder="No. Control">
            </div>
        </div>
        <div class="form-row">
            <label id="l" for="fecha_inicio"><b>Fecha</b></label>
            <input type="date" id="fecha_inicio" name="fecha_inicio">
            <label for="fecha_final"><b> a </b></label>
            <input type="date" id="fecha_final" name="fecha_final">
        </div>
        <div id="b">
            <br>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
</div>
<br>

<div class="container">
    <div class="form-group">
        @if ($buscar)
        @if ($asesorias->isEmpty())
        <div class="container">
            <div class="container alert alert-success">
                No hay resultados
            </div>
        </div>
        @else
        <form action="{{ route('reporte.pdf') }}" method="POST">
            {!! csrf_field() !!}
            <input type="text" name="docente" class="d-none" value="{!! $docente !!}">
            <input type="text" name="alumno" class="d-none" value="{!! $alumno !!}">
            <input type="text" name="carrera" class="d-none" value="{!! $carreras !!}">
            <input type="date" name="fecha_inicio" class="d-none" value="{!! $inicio !!}">
            <input type="date" name="fecha_final" class="d-none" value="{!! $fin !!}">
            <button type="submit" class="btn btn-success">Descargar pdf</button>
        </form>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>Fecha de solicitud</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de terminacion</th>
                    <th>Lugar</th>
                    <th>Unidad</th>
                    <th>Tema</th>
                    <th>Docente</th>
                    <th>Materia</th>
                    <th>Alumno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asesorias as $item)
                <tr>
                    <td>{!! $item->fechaSolicitud !!}</td>
                    <td>{!! $item->fechaRealizacion !!}</td>
                    <td>{!! $item->fechaTerminacion !!}</td>
                    <td>{!! $item->lugar !!}</td>
                    <td>{!! $item->unidad !!}</td>
                    <td>{!! $item->tema !!}</td>
                    <td>{!! $item->nom_docente !!}</td>
                    <td>{!! $item->nom_materia !!}</td>
                    <td>{!! $item->nom_alumno !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @endif
    </div>
</div>
<br><br>
@endsection