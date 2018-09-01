<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://d3js.org/d3.v5.min.js"></script>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"/>
        <!-- Styles -->
        <style>
                    html, body {
                        background-color: #fff;
                        color: #636b6f;
                        font-family: 'Raleway', sans-serif;
                        font-weight: 100;
                        height: 100vh;
                        margin: 0;
                    }
        
                    .full-height {
                        height: 100vh;
                    }
        
                    .flex-center {
                        align-items: center;
                        display: flex;
                        justify-content: center;
                    }
        
                    .position-ref {
                        position: relative;
                    }
        
                    .top-right {
                        position: absolute;
                        right: 10px;
                        top: 18px;
                    }
        
                    .content {
                        text-align: center;
                    }
        
                    .title {
                        font-size: 84px;
                    }
        
                    .links > a {
                        color: #636b6f;
                        padding: 0 25px;
                        font-size: 12px;
                        font-weight: 600;
                        letter-spacing: .1rem;
                        text-decoration: none;
                        text-transform: uppercase;
                    }
        
                    .m-b-md {
                        margin-bottom: 30px;
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
                                                var usuarios ='';
                                                var w = 300,              //width
                                                h = 300,                 //height
                                                r = 100,
                                                color = d3.scale.category20c();     //builtin range of colors
                                                var vis = d3.select("body")
                                                        .append("svg:svg")              //create the SVG element inside the <body>
                                                        .data([data])                   //associate our data with the document
                                                            .attr("width", w)           //set the width and height of our visualization (these will be attributes of the <svg> tag
                                                            .attr("height", h)
                                                        .append("svg:g")                //make a group to hold our pie chart
                                                            .attr("transform", "translate(" + r + "," + r + ")")    //move the center of the pie chart from 0, 0 to radius, radius
                
                                                var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
                                                    .outerRadius(r);
                
                                                var pie = d3.layout.pie()           //this will create arc data for us given a list of values
                                                    .value(function(d) { return d.value; });    //we must tell it out to access the value of each element in our data array
                
                                                var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
                                                    .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
                                                    .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
                                                        .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
                                                            .attr("class", "slice");    //allow us to style things in the slices (like text)
                
                                                    arcs.append("svg:path")
                                                            .attr("fill", function(d, i) { return color(i); } ) //set the color for each slice to be chosen from the color function defined above
                                                            .attr("d", arc);                                    //this creates the actual SVG path using the associated data (pie) with the arc drawing function
                
                                                    arcs.append("svg:text")                                     //add a label to each slice
                                                            .attr("transform", function(d) {                    //set the label's origin to the center of the arc
                                                            //we have to make sure to set these before calling arc.centroid
                                                            d.innerRadius = 0;
                                                            d.outerRadius = r;
                                                            return "translate(" + arc.centroid(d) + ")";        //this gives us a pair of coordinates like [50, 50]
                                                        })
                                                        .attr("text-anchor", "middle")                          //center the text on it's origin
                                                        .text(function(d, i) { return data[i].label; });        //get the label from our original data array
                                                    
                                                                            });
                                                                            $('#usuarios').html(usuarios);
                                                                            $('#Usuarios-button').hide();
                                                                        });
                                                                    });
                                                                });
                                </script>
            </div>
        </div>
    </body>
</html>
