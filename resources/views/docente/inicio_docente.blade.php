<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Docente</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <link rel="stylesheet" href="{!! asset('assets/css/inicio.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/docentes.css') !!}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark indigo" id="nav">

        <a class="navbar-brand" href="{{ url('/docente') }}">
            Inicio
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('docente/asesorias')}}">Asesorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('docente/materias')}}">Materias</a>
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
                        <img src="{{ asset('uploads/Imagenes/' . $docente->imagen) }}" class="d-inline-block align-top imgRedonda" alt="">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('docentes/perfil')}}">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
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
    <br><br>
    <div class="row">
        <div class="contenedorr">
            <div class="carta">

                <div class="lado frente">
                    <img src="{!! asset('assets/Images/materias.png') !!}" alt="">
                </div>
                <div class="lado atras">
                    <div class="card">
                        <div class="card-header"
                            style="background-image: url({!! asset('assets/Images/materias.png') !!})">
                            <div class="card-header-slanted-edge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                                    <path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
                                <a href="{{url('docente/materias')}}" class="btn-follow"><span class="sr-only">Ir</span></a>
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
                    <img src="{!! asset('assets/Images/historial.png') !!}" alt="">
                </div>
                <div class="lado atras">
                    <div class="card">
                        <div class="card-header"
                            style="background-image: url({!! asset('assets/Images/historial.png') !!})">
                            <div class="card-header-slanted-edge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                                    <path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
                                <a href="{{url('docente/asesorias')}}" class="btn-follow"><span class="sr-only">Ir</span></a>
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