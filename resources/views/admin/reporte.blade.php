<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h1><center>Reporte de asesorias</center></h1>
    @if ($fecha)
        Asesorias de {!! $inicio !!} a {!! $fin !!} <br>
    @endif
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark ">
            <tr>
                <th>Fecha de asesoria</th>
                <th>Unidad</th>
                <th>Tema</th>
                <th>Docente</th>
                <th>Materia</th>
                <th>Alumno</th>
                <th>Observacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asesorias as $item)
            <tr>
                <td>{!! $item->fechaTerminacion !!}</td>
                <td>{!! $item->unidad !!}</td>
                <td>{!! $item->tema !!}</td>
                <td>{!! $item->nom_docente !!}</td>
                <td>{!! $item->nom_materia !!}</td>
                <td>{!! $item->nom_alumno !!}</td>
                <td>{!! $item->observaciones !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>