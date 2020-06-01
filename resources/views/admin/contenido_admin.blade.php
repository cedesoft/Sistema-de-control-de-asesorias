<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRUD Admin</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark indigo" id="nav">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- Parte izquierda del navBar --}}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('agregar/docente')}}">Docentes
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('agregar/materia')}}">Materias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{url('agregar/alumno')}}">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('agregar/carrera')}}">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('reportes/admin')}}">Reportes</a>
                </li>
                @if (!Auth::user()->hasRole('coordinador'))
                <li class="nav-item">
                    <a class="nav-link" href="{{url('agregar/coordinador')}}">Coordinador</a>
                </li>
                @endif
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
                        @if (Auth::user()->hasRole('coordinador'))
                        <img src="{{ asset('uploads/Imagenes/' . $coordi->imagen) }}"
                            class="d-inline-block align-top imgRedonda" alt="">
                        @endif
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->hasRole('coordinador'))
                        <a class="dropdown-item" href="{{url('coordinador/perfil')}}">Perfil</a>
                        <div class="dropdown-divider"></div>
                        @endif
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
    <!--End NavBar -->

    <!-- Yield -->
    @yield('agregar_alumno')
    @yield('agregar_carrera')
    @yield('agregar_docente')
    @yield('agregar_materias')
    @yield('reportes_admin')
    @yield('agregar_coordi')
    <!-- Footer -->
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
    <!-- End Footer -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>