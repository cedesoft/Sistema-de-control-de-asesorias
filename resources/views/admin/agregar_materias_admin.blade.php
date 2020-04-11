@extends('admin/contenido_admin')
@section('agregar_materias')
<h2></h2>
<div>
    <form id="formulario" class="img">
        <h2><b>Materias</b></h2>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label id="l" for="exampleInputEmail1"><b>Nombre</b></label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre">
            </div>
            <div class="form-group ">
                <label id="l" for="exampleInputEmail1"><b>Carrera</b></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="carrera"
                    placeholder="Carrera">
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                <label class="custom-file-label" for="validatedCustomFile"> Buscar Excel
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <div id="b">
                <br>
                <button type="submit" class="btn btn-success">
                    Cargar Excel<i style='font-size:20px' class='fas'>&#xf1c3;</i></button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
    </form>
</div>
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