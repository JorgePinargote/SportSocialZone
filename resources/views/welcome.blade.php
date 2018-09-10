<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="http://d3js.org/d3.v3.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"/>
        <link href='{{ asset('css/graficas.css') }}' rel="stylesheet"/>
    </head>
    <body>
        <div class= "container">
            <header>
                <div class="flex-center position-ref full-height ">
                    @if (Route::has('login'))
                    <div class="top-right links">
                        <div class="dropdown">
                            @auth
                            <a id="my-dropdown" href="{{ url('/auth/elegir') }}" class="btn btn-dark  " data-toggle="dropdown">Home</a>
                            @else
                            <a id="my-dropdown" href="{{ route('login') }}" class="btn btn-primary" data-toggle="dropdown">Login</a>
                            <a id="my-dropdown" href="{{ route('register') }}" class="btn" data-toggle="dropdown">Register</a>
                            @endauth
                        </div>
                    </div>
                    @endif
                </div>
            </header>
            <section>
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <h2>Data Table</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-9 tabla">
                        <table class = "table table-bordered table-hover" id='myTable'>
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Equipos</th>
                                    <th>Deporte</th>
                                    <th>Publicaciones</th>
                                    <th>Contenido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($publicaciones as $publicacion)
                                <tr>
                                    <td>{{ $publicacion->idequipo }}</td>
                                    <td>{{ $publicacion->equipo }}</td>
                                    <td>{{ $publicacion->deporte }}</td>
                                    <td>{{ $publicacion->titulo }}</td>
                                    <td>{{ $publicacion->texto }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-6 grafic">
                        <h1>Gráficas estadísticas</h1>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5">
                        <h3>Deportes por Equipos</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <svg id='barGraph' width = "1000" height = "400"></svg>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5">
                        <h3>Usuarios Registrados</h3>
                    </div>
                </div>
                <div class="row"></div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <svg id='pieChart' width = "400" height = "400"></svg>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Reporte de Publicaciones por Equipo</h2>
                        <div class="dropdown">
                            <a href="{{ url('/pdf') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Ver Reporte</a>
                            <a href="{{ url('/pdf2') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Descargar Reporte</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="/js/welcome.js"></script>
    </body>
</html>
