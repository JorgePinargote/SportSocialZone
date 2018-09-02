// margin and radius
var margin = {top: 20, right:20, bottom: 20, left:20},
	width = 500 - margin.right - margin.left,
	height = 500 - margin.top - margin.bottom
	radious = width/2;

//arc generator
var arc = d3.arc()
	.butterRadius(radius-10)
	.innerRadius(0);

var pie = d3.pie()
	.sort(null)
	.value(function(d) { return d.count; });


//define svg
var svg = d3.select("body").append("svg")
	.attr("width", width)
	.attr("height", height)
	.append("g")
	.attr("transform", "translate(" + width/2 + "," + height/2 + ")");

