$(document).ready(function() {
    $('#myTable').DataTable({
        "columnDefs":[{
            "targets":0,
            "searchable":false,
            "visible":false
        }]
    });


    var margin = {
            top: 20,
            right: 20,
            bottom: 70,
            left: 40
        },
        width = 600 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;
    var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);
    var y = d3.scale.linear().range([height, 0]);
    var xAxis = d3.svg.axis().scale(x).orient("bottom")
    var yAxis = d3.svg.axis().scale(y).orient("left").ticks(10);
    var svg = d3.select("#barGraph").append("svg").attr("width", width + margin.left + margin.right).attr("height", height + margin.top + margin.bottom).append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    $(function() {
        $.get('grafico-equipos-deporte', function(data) {
            $.each(data, function(i, d) {
                d.deporte = d.deporte;
                d.equipos = d.equipos;
            });
            x.domain(data.map(function(d) {
                return d.deporte;
            }));
            y.domain([0, d3.max(data, function(d) {
                return d.equipos;
            })]);
            svg.append("g").attr("class", "x axis").attr("transform", "translate(0," + height + ")").call(xAxis).selectAll("text").style("text-anchor", "end").attr("dx", "-.8em").attr("dy", "-.55em").attr("transform", "rotate(-90)");
            svg.append("g").attr("class", "y axis").call(yAxis).append("text").attr("transform", "rotate(-90)").attr("y", 5).attr("dy", ".71em").style("text-anchor", "end").text("Equipos");
            svg.selectAll("bar").data(data).enter().append("rect").attr("class", "bar").attr("x", function(d) {
                return x(d.deporte);
            }).attr("width", x.rangeBand()).attr("y", function(d) {
                return y(d.equipos);
            }).attr("height", function(d) {
                return height - y(d.equipos);
            });
        });
    });


    var w = 400;
    var h = 400;
    var r = h / 2;
    var aColor = ['rgb(178, 55, 56)', 'rgb(239, 183, 182)']
    $(function() {
        $.get('grafico-userstoday', function(data) {
            console.log(data);
            // var counts = {};
            var vis = d3.select('#pieChart').append("svg:svg").data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
            var pie = d3.layout.pie().value(function(d) {
                return d.value;
            });
            var arc = d3.svg.arc().outerRadius(r);
            var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice");
            arcs.append("svg:path").attr("fill", function(d, i) {
                return aColor[i];
            }).attr("d", function(d) {
                return arc(d);
            });
            arcs.append("svg:text").attr("transform", function(d) {
                d.innerRadius = 100; /* Distance of label to the center*/
                d.outerRadius = r;
                return "translate(" + arc.centroid(d) + ")";
            }).attr("text-anchor", "middle").text(function(d, i) {
                return data[i].label+"  " +data[i].value;
            });
        });
    });
});