<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar asesoria</title>

    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/docentes.css') !!}">

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark indigo" id="footer">
        <a class="navbar-brand" href="#">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Solicitud
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Acesorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Materias</a>
                </li>
            </ul>
            <span class="navbar-text white-text">
                Alumno
            </span>
        </div>
    </nav>
    <!-- End header -->
    <!-- yields -->
    @yield('asesorias_alumno')
    @yield('solicitar')
    @yield('lista_materias')
    @yield('lista_docentes')

    <footer id="footer" class="pb-4 pt-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-lg">
                    <a href="http://itsn.edu.mx/s-02/itsn.edu.mx/">
                        <h5>Instituto Tecnologico Superior de Nochistlan</h5>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>