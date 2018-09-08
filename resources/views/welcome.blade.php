<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <script src="https://d3js.org/d3.v4.min.js"> </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
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
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <h3>Usuarios Registrados</h3>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12"></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div id="usuarios"></div>
                            <svg width = "400" height = "400"></svg>
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
                                                $('#usuarios').html(svg);
                                                $('#Usuarios-button').hide();
                                            });
                                        });
                                </script>
                    </div>
                    <div class="col-sm-3 data1">
                    </div>
                    <div class="col-sm-12">
                        <h2>Reporte de Equipos Registrados</h2>
                        <div class="dropdown">
                            <a id="my-dropdown" href="{{ url('/pdf') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Ver Reporte</a>
                            <a id="my-dropdown" href="{{ url('/pdf2') }}" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Descargar Reporte</a>

                        </div>
                    </div>
                    </div>     
                </div>
            </section>
            <footer>
                
            </footer>
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
