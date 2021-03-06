<!DOCTYPE html>
<html lang="en">

<head>
    <title>Solicitar asesoria</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/x-icon" href="https://itsn.edu.mx/s-02/itsn.edu.mx/images/logotipo.png" />
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/docentes.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark indigo" id="nav">

        <a class="navbar-brand" href="{{ url('alumno') }}">
            Inicio
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('asesorias/alumno')}}">Asesorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('alumno/docentes')}}">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('alumno/materias')}}">Materias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://drive.google.com/drive/folders/1KOja9eY_HTtphaUmNWorcQ2HOgo9nlLW?usp=sharing">Descargar App</a>
                </li>
            </ul>

            {{-- Parte derecha del navBar --}}
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
               
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{ asset('uploads/Imagenes/' . $alumno->imagen) }}" class="d-inline-block align-top imgRedonda" alt="">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('alumnos/perfil')}}">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>