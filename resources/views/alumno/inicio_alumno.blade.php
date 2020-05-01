<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Alumno</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <link rel="stylesheet" href="{!! asset('assets/css/inicio.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/navbar.css') !!}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark indigo" id="footer">
        <a class="navbar-brand" href="#">Inicio</a>
        <a class="nav-link" href="#">Acesorias</a>
        <a class="nav-link" href="#">Docentes</a>
        <a class="nav-link" href="{{url('alumno/materias')}}">Materias</a>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>

            </ul>
            <span class="navbar-text white-text">
                Alumno
            </span>
        </div>
    </nav>
    <div><br><br></div>
    <div class="row">
        <div class="contenedorr">
            <div class="carta">
                <div class="lado frente">
                    <img src="{!! asset('assets/images/docentes.png') !!}" alt="">
                </div>
                <div class="lado atras">
                    <div class="card">
                        <div class="card-header"
                            style="background-image: url({!! asset('assets/images/docentes.png') !!})">
                            <div class="card-header-slanted-edge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                                    <path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
                                <a href="#" class="btn-follow"><span class="sr-only">Ir</span></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="name">Docentes</h2>
                            <div class="bio">Consultar docentes que pueden ofrecer asesorías segun la carrera</div>
                            <div class="social-accounts">
                                <i class='fas fa-users' style='font-size:24px'></i>
                                <i class='fas fa-list-alt' style='font-size:24px'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contenedorr">
            <div class="carta">
                <div class="lado frente">
                    <img src="{!! asset('assets/images/materias.png') !!}" alt="">
                </div>
                <div class="lado atras">
                    <div class="card">
                        <div class="card-header"
                            style="background-image: url({!! asset('assets/images/materias.png') !!})">
                            <div class="card-header-slanted-edge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                                    <path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
                                <a href="#" class="btn-follow"><span class="sr-only">Ir</span></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="name">Materias</h2>
                            <div class="bio">Consultar el listado de materias para solicitar asesoría</div>
                            <div class="social-accounts">
                                <i class='fas fa-book' style='font-size:24px'></i>
                                <i class='fas fa-pencil-alt' style='font-size:24px'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contenedorr">
            <div class="carta">
                <div class="lado frente">
                    <img src="{!! asset('assets/images/historial.png') !!}" alt="">
                </div>
                <div class="lado atras">
                    <div class="card">
                        <div class="card-header"
                            style="background-image: url({!! asset('assets/images/historial.png') !!})">
                            <div class="card-header-slanted-edge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                                    <path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
                                <a href="#" class="btn-follow"><span class="sr-only">Ir</span></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="name">Historial</h2>
                            <div class="bio">Historial de las asesorías recibidas</div>
                            <div class="social-accounts">
                                <i class='fas fa-history' style='font-size:24px'></i>
                                <i class='fas fa-address-book' style='font-size:24px'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>