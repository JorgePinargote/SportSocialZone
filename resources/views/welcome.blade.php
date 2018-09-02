<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://d3js.org/d3.v4.min.js"> </script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
        //<script src="https://d3js.org/d3.v5.min.js"></script>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"/>
        <!-- Styles -->
    <style>
        #chart-area svg {
            margin:auto;
            display:inherit;
        }
        text {
            font: 10px sans-serif;
        }
        form {
            position: absolute;
            right: 10px;
            top: 10px;
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
                <script>
                    $(function(){
                        $('#Usuarios-button').on('click',function(e){
                            e.preventDefault();
                            $('#usuarios').html('cargando...');
                            $.get('grafico-userstoday',function(data){
                                var data = !{JSON.stringify(data)};

                                var height = 800,
                                    width= 500,
                                    radius = Math.min(width, height)/2;

                                var color = d3.scaleOrdinal(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);
                                var arc = d3.arc()
                                        .outerRadius(radius - 10)
                                        .innerRadius(0);
                                var labelArc = d3.arc()
                                        .outerRadius(radius - 40)
                                        .innerRadius(radius - 40);

                                var pie = d3.pie()
                                        .sort(null)
                                        .value( function(d){
                                            return d.entrenadores;
                                        });
                                var svg = d3.select("body").append("svg")
                                            .attr("width", width)
                                            .attr("height", height)
                                        .append("g")
                                            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");    
                                var g = svg.selectAll(".arc")
                                            .data(pie(data))
                                        .enter().append("g")
                                            .attr("class", "arc");
                                g.append("path")
                                    .attr("d", arc)
                                    .style("fill", function(d) { return color(d.data.generales); });
                                g.append("text")
                                    .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
                                    .attr("dy", ".35em")
                                    .text(function(d) { return d.data.generales; });
                                $('#usuarios').html(data);
                                $('#Usuarios-button').hide();
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </body>
</html>
