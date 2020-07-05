<!DOCTYPE html>
<html lang="en" class="html">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/perfil.css') !!}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-image:linear-gradient(
    rgba(206, 206, 248, 0.5),
    rgba(86, 123, 156, 0.5)
    ), url({!! asset('assets/Images/login.jpeg') !!})">
    <main class="main">
        <aside class="sidebar">
            <nav class="nav">
                <ul>
                    <li><a href="{{url('reportes/admin')}}">Reportes</a></li>
                    <li><a href="{{url('agregar/alumno')}}">Alumnos</a></li>
                    <li><a href="{{url('agregar/docente')}}">Docentes</a></li>
                    <li><a href="{{url('agregar/materia')}}">Materias</a></li>
                </ul>
            </nav>
        </aside>

        <section>
            <div class="twitter">
                <form class="container" action="{{ route('addImgCoordi') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div>
                        <div class="form-group">
                            <center>
                                <img src="{{ asset('uploads/Imagenes/' . $coordinador->imagen) }}" class="imgRedonda"
                                    alt="No se puede cargar la imagen" class="img-rounded">
                            </center>
                            <br>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto"
                                        aria-describedby="inputGroupFileAddon04" required>
                                    <label class="custom-file-label" for="foto">Elegir foto</label>
                                </div>
                            </div>

                            <div class="input'group">
                                <label for="name"><b>Nombre:</b></label>
                                <input class="form-control" type="text" id="name" name="nombre" value="{!! $coordinador->nombre!!}" disabled>

                                <label for="mail"><b>Correo electrónico:</b></label>
                                <input class="form-control" type="email" id="mail" name="email" value="{!! $coordinador->correo!!}" disabled >

                            </div>
                        </div>
                    </div>

                    <div align="center">
                        <br><button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>