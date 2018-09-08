<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://d3js.org/d3.v3.min.js"></script>
        {{-- <script src="https://d3js.org/d3.v4.min.js"> </script> --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"/>
        <!-- Styles -->
        <style>
            .bar{
                fill: steelblue;
            }

            .bar:hover{
                fill: brown;
            }

            .axis {
                font: 10px sans-serif;
            }

            .axis path,
            .axis line {
                fill: none;
                stroke: #000;
                shape-rendering: crispEdges;
            }
        </style>

    </head>
    <body>
        <div class= "content">
            <header>
                <div class="flex-center position-ref full-height">
                    @if (Route::has('login'))
                    <div class="top-right links">
                        <div class="dropdown">
                            @auth
                            <a id="my-dropdown" href="{{ url('/home') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Home</a>
                            @else
                            <a id="my-dropdown" href="{{ route('login') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Login</a>
                            <a id="my-dropdown" href="{{ route('register') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Register</a>
                            @endauth
                        </div>
                    </div>
                    @endif
                </div>
            </header>
            <section>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-6">
                        <h1>Gráficas estadísticas</h1>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5">
                        <h3>Deportes por Equipos</h3>
                    </div>
                    <div class="col-sm-5">
                        <h3>Usuarios Registrados</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12"></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5">
                    <svg id='barGraph' width = "400" height = "400"></svg>
                       <script> 
                            var margin = {top: 20, right: 20, bottom: 70, left: 40},
                                width = 600 - margin.left - margin.right,
                                height = 300 - margin.top - margin.bottom;
                            var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);
                            var y = d3.scale.linear().range([height, 0]);
                            var xAxis = d3.svg.axis()
                                .scale(x)
                                .orient("bottom")
                            var yAxis = d3.svg.axis()
                                .scale(y)
                                .orient("left")
                                .ticks(10);
                            var svg = d3.select("#barGraph").append("svg")
                                .attr("width", width + margin.left + margin.right)
                                .attr("height", height + margin.top + margin.bottom)
                               .append("g")
                                .attr("transform",
                                    "translate(" + margin.left + "," + margin.top + ")");
                            $(function(){
                                $.get('grafico-equipos-deporte', function(data){
                                    $.each(data, function(i, d) {
                                        d.deporte = d.deporte;
                                        d.equipos = d.equipos;
                                    });
                                    x.domain(data.map(function(d) { return d.deporte; }));
                                    y.domain([0, d3.max(data, function(d) { return d.equipos; })]);
                                    svg.append("g")
                                        .attr("class", "x axis")
                                        .attr("transform", "translate(0," + height + ")")
                                        .call(xAxis)
                                    .selectAll("text")
                                        .style("text-anchor", "end")
                                        .attr("dx", "-.8em")
                                        .attr("dy", "-.55em")
                                        .attr("transform", "rotate(-90)" );
                                     svg.append("g")
                                        .attr("class", "y axis")
                                        .call(yAxis)
                                    .append("text")
                                        .attr("transform", "rotate(-90)")
                                        .attr("y", 5)
                                        .attr("dy", ".71em")
                                        .style("text-anchor", "end")
                                        .text("Equipos");
                                    svg.selectAll("bar")
                                        .data(data)
                                    .enter().append("rect")
                                        .attr("class", "bar")
                                        .attr("x", function(d) { return x(d.deporte); })
                                        .attr("width", x.rangeBand())
                                        .attr("y", function(d) { return y(d.equipos); })
                                        .attr("height", function(d) { return height - y(d.equipos); });
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-5">
                        <svg id='pieChart' width = "400" height = "400"></svg>
                            <script>
                                var w = 400;
                                var h = 400;
                                var r = h/2;
                                var aColor = [
                                    'rgb(178, 55, 56)',
                                    'rgb(213, 69, 70)',
                                    'rgb(230, 125, 126)',
                                    'rgb(239, 183, 182)'
                                ]
                                $(function(){
                                    $.get('grafico-userstoday', function(data){
                                        // var counts = {};
                                        console.log(data);
                                        var vis = d3.select('#pieChart').append("svg:svg").data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
                                        var pie = d3.layout.pie().value(function(d){return d.value;});
                                        var arc = d3.svg.arc().outerRadius(r);
                                        var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice");
                                        arcs.append("svg:path")
                                            .attr("fill", function(d, i){return aColor[i];})
                                            .attr("d", function (d) {return arc(d);});
                                        arcs.append("svg:text")
                                            .attr("transform", function(d){
                                                d.innerRadius = 100; /* Distance of label to the center*/
                                                d.outerRadius = r;
                                                return "translate(" + arc.centroid(d) + ")";}
                                            )
                                            .attr("text-anchor", "middle")
                                            .text( function(d, i) {return data[i].value + '%';});
                                    });
                                });
                            </script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Reporte de Publicaciones por Equipo</h2>
                        <div class="dropdown">
                            <a id="my-dropdown" href="{{ url('/pdf') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Ver Reporte</a>
                            <a id="my-dropdown" href="{{ url('/pdf2') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Descargar Reporte</a>

                        </div>
                    </div>
                </div>    
            </section>
        </div>
    </body>

            {{-- <div class="content">
                <div class="table">
                    <table>
                        <tr>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div id="usuarios"></div>
                                        <svg width = "200" height = "200"></svg>
                                            <script>
                                                $(function(){
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
                                            </script>
                                </div>  
                            </div>
                        </tr>
                        <tr>
                            <div id="barGraph"></div>
                                <svg width = "400" height = "400"></svg>
                                    <script>
                                        $(function(){
                                                $.get('grafico-equipos-deporte',function(data){
                                                    var datax = new Array();
                                                    var count = Object.keys(data).length;
                                                    var i;
                                                    for(i=0; i<count; i++){
                                                        datax[i] = data[i].equipos;
                                                        //console.log(data[i]);
                                                    }
                                                    console.log(data);
                                                    console.log(datax);
                                                    var margin = {top: 20, right: 20 , bottom: 100, left:60},
                                                        width = 400 - margin.left - margin.right,
                                                        height = 200 - margin.top - margin.bottom,
                                                        x = d3.scaleBand().rangeRound([0, width]).padding(0.5),
                                                        y = d3.scaleLinear().rangeRound([height,0]);
                                                    var xAxis = d3.axisBottom(x)
                                                    var yAxis = d3.axisLeft(y)
                                                        .ticks(5);
                                                    var svg = d3.select("#barGraph")
                                                        .append("svg")
                                                        .attr("width", width + margin.left + margin.right)
                                                        .attr("height", height+ margin.top + margin.bottom)
                                                        .append("g")
                                                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
                                                    x.domain(d3.extent(datax, function(d){
                                                        return d;
                                                    }))  
                                                    y.domain([0, d3.max(datax, function(d){
                                                        return d;
                                                    })])  
                                                    var config = { columnWidth: 45, columnGap: 5, margin: 10, height: 235 };
                                                    d3.select("svg")
                                                      .selectAll("rect")
                                                      .data(datax)
                                                    .enter().append("rect")
                                                      .attr("width", config.columnWidth)
                                                      .attr("x", function(d,i) {
                                                         return config.margin + i * (config.columnWidth + config.columnGap)
                                                       })
                                                      .attr("y", function(d,i) { return config.height - d })
                                                      .attr("height", function(d,i) { return d });
                                                });                                
                                            });
                                    </script>  
                        </tr>
                    </table>
                </div>
            </div> --}}

</html>
