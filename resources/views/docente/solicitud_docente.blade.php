@extends('docente/contenido_docente')
@section('solicitud')
<h2></h2>
<div>
    <form id="formulario" class="img">
        <h2><b>Solicitar de Asesoria</b></h2>
        <div class="form-group ">
            <label id="l" for="exampleInputEmail1"><b>Nombre</b></label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Nombre alumno">
        </div>
        <div class="form-group">
            <label id="l" for="exampleFormControlSelect1"><b>Materias</b></label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>Opciones</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label id="l" for="exampleFormControlSelect1"><b>Unidad</b></label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label id="l" for="exampleFormControlSelect1"><b>Situacion academica</b></label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>Opciones</option>
                <option>El estudiante ha reprobado la unidad</option>
                <option>El docente la considero necesaria</option>
                <option>El estudiante la solicito por su cuenta</option>
            </select>
        </div>
        <div class="form-group ">
            <label id="l" for="exampleInputEmail1"><b>Tema</b></label>
            <textarea name="" id="" cols="30" rows="10" placeholder="Ingresa detalles del tema"></textarea>
        </div>
    </form>
    <br>
</div>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="form-group col-md-8">
            <input class="form-control" type="text" placeholder="No. Control" aria-label="Search">
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">
                Agregar<i style='font-size:18px' class="material-icons">&#xe7fe;</i></button>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th>No. Control</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="b">
    <br>
    <button type="submit" class="btn btn-danger">Cancelar</button>
    <button type="submit" class="btn btn-primary">Solicitar</button>
</div>
<br>
<br>
@endsection