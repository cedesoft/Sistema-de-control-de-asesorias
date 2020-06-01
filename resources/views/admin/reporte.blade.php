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
    @foreach ($asesorias as $item)
    <div class="card mb-3">
        <div class="card-header">

        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">
                Fecha de solicitud: {!! $item->fechaSolicitud !!}<br>
                Fecha de inicio: {!! $item->fechaRealizacion !!} <br>
                Fecha de terminacion: {!! $item->fechaTerminacion !!} <br>
                Lugar: {!! $item->lugar !!} <br>
                Unidad de la materia: {!! $item->unidad !!} <br>
                Tema: {!! $item->tema !!} <br> 
                Docente: {!! $item->nom_docente !!} <br>
                Materia: {!! $item->nom_materia !!} <br>
                Alumno: {!! $item->nom_alumno !!} <br>
            </p>
        </div>
    </div>
    @endforeach

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