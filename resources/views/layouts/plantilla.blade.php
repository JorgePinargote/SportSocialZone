<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>
        <meta charset="utf-8"/>
        <meta name= "viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Finger%20Paint" rel='stylesheet'/>
        <link href='{{ asset('css/style.css') }}' rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Antic+Slab" rel="stylesheet"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid" id="cabecera">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img id="logo" alt="no cargó" src="{{ asset('image/zs.jpg') }}"/>
                    </a>
                </div>
                <div class="collapse navbar-collapse " id="myNavbar">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="active">
                            <a href="/login.html">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" id="cuerpo">@yield('content')</div>
        <footer></footer>
    </body>
</html>
