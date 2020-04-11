@extends('coordinador/contenido_coordi')
@section('agregar_docentes')
<h2></h2>
<div>
    <form id="formulario" class="img">
        <h2><b>Docentes</b></h2>
        <div class="form-group ">
            <label id="l" for="exampleInputEmail1"><b>Nombre</b></label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="nombre"
                placeholder="Nombre">
        </div>
        <div class="form-group ">
            <label id="l" for="exampleInputEmail1"><b>Correo</b></label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>
        <div class="form-group">
            <label id="l" for="exampleInputPassword1"><b>Contraseña</b></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label id="l" for="exampleFormControlSelect1"><b>Materias</b></label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div id="b">
            <button type="submit" class="btn btn-success">
                Cargar Excel.<i style='font-size:20px' class='fas'>&#xf1c3;</i></button>
            <button type="submit" class="btn btn-primary">
                Agregar<i style='font-size:18px' class="material-icons">&#xe7fe;</i></button>
        </div>
    </form>
    <br>
</div>

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
                <th>Nombre</th>
                <th>Correo</th>
                <th>Materias</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
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