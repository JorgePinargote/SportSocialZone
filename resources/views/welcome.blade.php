<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://d3js.org/d3.v4.min.js"> </script>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"/>
        <!-- Styles -->
    <style>
        .arc text {
            font: 10px sans-serif;
            text-anchor:middle;
        }
        .arc path{
            stroke: teal;
            stroke-width: 3.5px;
        }

    </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
            @endif
            <div class="content">
                <a href="#" id="Usuarios-button">Cargar Usuarios</a>
                <div id="usuarios"></div>
                <svg width = "748" height = "530"></svg>
                <script>
                    $(function(){
                        $('#Usuarios-button').on('click',function(e){
                            e.preventDefault();
                            $('#usuarios').html('cargando...');
                            $.get('grafico-userstoday',function(data){
                                var data2 = new Array(2);
                                data2[0] = data.entrenadores;
                                data2[1] = data.generales;
                                console.log(data);
                                console.log(data2);
                                var svg = d3.select("svg"),
                                    width = svg.attr("width"),
                                    height = svg.attr("height"),
                                    radius = Math.min(width, height)/2;

                                var g = svg.append("g")
                                    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
                                var color = d3.scaleOrdinal(['green', 'brown']);
                                var pie = d3.pie().value(function(d) { 
                                    return d; 
                                });
                                var path = d3.arc()
                                    .outerRadius(radius - 10).innerRadius(20);
                                var label = d3.arc()
                                    .outerRadius(radius).innerRadius(radius - 80);
                                var arc = g.selectAll(".arc")
                                    .data(pie(data2))
                                    .enter()
                                    .append("g")
                                    .attr("class", "arc");
                                arc.append("path")
                                    .attr("d", path)
                                    .attr("fill", function(d) { return color(d.data2); });
                                console.log(arc);
                                arc.append("text").attr("transform", function(d) { 
                                    return "translate(" + label.centroid(d) + ")"; 
                                })
                                .text(function(d) { return d.data2; });
                                svg.append("g")
                                    .attr("transform", "translate(" + (width / 2 - 120) + "," + 20 + ")")
                                    .append("text").text("Usuarios Registrados")
                                    .attr("class", "title")
                                $('#usuarios').html(svg);
                                $('#Usuarios-button').hide();
                                
                            });
                        });
                    });
                </script>
                <script>
                    <a href="#" id="Equipos-button">Cargar Equipos</a>
                    <div id="equipos"></div>
                    <svg width = "748" height = "530"></svg>
                    $(function(){
                        $('#Equipos-button').on('click',function(e){
                            e.preventDefault();
                            $('#equipos').html('cargando...');
                            $.get('grafico-userstoday',function(data){
                                var data2 = new Array(2);
                                data2[0] = data.entrenadores;
                                data2[1] = data.generales;
                                console.log(data);
                                console.log(data2);
                                var svg = d3.select("svg"),
                                    width = svg.attr("width"),
                                    height = svg.attr("height"),
                                    radius = Math.min(width, height)/2;

                                var g = svg.append("g")
                                    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
                                var color = d3.scaleOrdinal(['green', 'brown']);
                                var pie = d3.pie().value(function(d) { 
                                    return d; 
                                });
                                var path = d3.arc()
                                    .outerRadius(radius - 10).innerRadius(20);
                                var label = d3.arc()
                                    .outerRadius(radius).innerRadius(radius - 80);
                                var arc = g.selectAll(".arc")
                                    .data(pie(data2))
                                    .enter()
                                    .append("g")
                                    .attr("class", "arc");
                                arc.append("path")
                                    .attr("d", path)
                                    .attr("fill", function(d) { return color(d.data2); });
                                console.log(arc);
                                arc.append("text").attr("transform", function(d) { 
                                    return "translate(" + label.centroid(d) + ")"; 
                                })
                                .text(function(d) { return d.data2; });
                                svg.append("g")
                                    .attr("transform", "translate(" + (width / 2 - 120) + "," + 20 + ")")
                                    .append("text").text("Equipos por Deporte")
                                    .attr("class", "title")
                                $('#equipos').html(svg);
                                $('#Equipos-button').hide();
                                
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </body>
</html>

