// D3.js Map

var w = 1000;
var h = 500;

// Parse the date
// var parseDate = d3.time.format("%m-%d-%Y").parse;

//Define map projection to account for 2D
var projection = d3.geo.albersUsa()
      .translate([w/2, h/2])
      .scale([1000]);

//Define path generator
var path = d3.geo.path()
      .projection(projection);

// var color = d3.scale.quantize()
//       .range(["rgb(237,248,233)","rgb(186,228,179)","rgb(116,196,118)","rgb(49,163,84)","rgb(0,109,44)"]);
          
//Create SVG element
var svg = d3.select("#map")
      .append("svg")
      .attr("id", "svg")
      .attr("width", w)
      .attr("height", h);

var divs = $("div.tooltips");

if (divs.length === 0) {
  var div = d3.select("#map")
      .append("div")
      .attr("class", "tooltips")
      .style("opacity", 0);
} else {
    var div = d3.select("div.tooltips");
}

var g = svg.append("g");

//Load in GeoJSON data
d3.json("d3/us-states.json", function(json) {

  g.append('g')
      .attr("id", "states")
      .selectAll("path")
      .data(json.features)
      .enter()
      .append('g')
      .attr("class","state-path")
      .attr("state", function(d) {
          return d.state;
      });
      
  svg.selectAll(".state-path")
      .append("path")
      .attr("d", path)
      .style("fill", "#9494FF")
      .style("stroke-width", "1.5")
      .style("stroke", "white")
      // .attr("class", "state")
      .on('click', clicked)
      .on('mousemove', mousemove)
      .on('mouseout', mouseout);
       
    
  svg.append("rect")
      .attr("fill", "none")
      .attr("width", w)
      .attr("height", h) 
      .style('stroke', 'none');

  d3.csv("d3/state-centers.csv", function(data) {
      svg.selectAll("circle")
         .data(data)
         .enter()
         .append("circle")
         .attr("cx", function(d) {
                 return projection([d.lon, d.lat])[0];
         })
         .attr("cy", function(d) {
                 return projection([d.lon, d.lat])[1];
         })
         .attr("r", 3)
         .style("fill", "red")
         .style('opacity', 0);
         
      svg.selectAll("text")
         .data(data)
         .enter()
       .append("text") // append text
         .attr("x", function(d) {
                 return projection([d.lon, d.lat])[0];
         })
         .attr("y", function(d) {
                 return projection([d.lon, d.lat])[1];
         })
         .attr("dy", +5) // set y position of bottom of text
        .style('font-family', "Verdana")
        .style("fill", "#00000") // fill the text with the colour black
        .attr("text-anchor", "middle") // set anchor y justification
        .text(function(d) {return d.state;}); // define the text to display

  });

  d3.select('#map')
        .on('click', function(){
          svg.selectAll('circle')
              .style('opacity', 0);
        })

  d3.select('#map')
        .on('mouseout', function(){
          svg.selectAll('circle')
              .style('opacity', 0);
        })
});

function clicked(d){
  d3.select(this).style("fill", "white")

}

function mousemove(d){

  var state = $(this).attr("state");
    div.transition().duration(200).style("opacity", 1);
    div.html(d.properties.name + "<br/>" + d.id + "<br/>" +
    "STATE")
            .style("left", (d3.event.pageX - 110) + "px")
            .style("top", (d3.event.pageY - 630) + "px");

  d3.select(this).style("fill", "white");
}

function mouseout(d){
  div.transition().duration(200).style("opacity", 0);

  d3.select(this).style('fill', '#9494FF');
}