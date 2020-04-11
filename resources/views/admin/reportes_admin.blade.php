@extends('admin/contenido_admin')
@section('reportes_admin')
<h2></h2>
<div>
    <form id="formulario" class="img">
        <h2><b>Reportes</b></h2>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label id="l" for="exampleInputEmail1"><b>Carrera</b></label>
            </div>
            <div class="form-group col-md-6">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="button" class="btn btn-primary ">Buscar</button>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label id="l" for="exampleInputEmail1"><b>Docente</b></label>
            </div>
            <div class="form-group col-md-6">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nombre">
            </div>
            <div class="form-group col-md-2">
                <button type="button" class="btn btn-primary ">Buscar</button>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label id="l" for="exampleInputEmail1"><b>Alumnos</b></label>
            </div>
            <div class="form-group col-md-6">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="No. Control">
            </div>
            <div class="form-group col-md-2">
                <button type="button" class="btn btn-primary ">Buscar</button>
            </div>
        </div>
        <div id="c">
            <label for="exampleInputEmail1"><b>Institucion</b></label>
            <button type="button" class="btn btn-primary ">Buscar</button>
        </div>
        <div class="form-row">
            <label id="l" for="exampleInputEmail1"><b>Fecha</b></label>
            <input type="date" id="start" name="trip-start">
            <label for="exampleInputEmail1"><b> a </b></label>
            <input type="date" id="start" name="trip-start">
        </div>
        <div id="b">
            <br>
            <button type="submit" class="btn btn-primary">Generar</button>
        </div>
    </form>
</div>
<br>


<div class="container">
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>

@endsection