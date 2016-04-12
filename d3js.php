<?php include("inc/header.php"); ?>
	<header class="d3-top">
        <div class="map-size">
	        <div id="map"></div> 
        </div>
		<h3 class="d3-page">Exploring D3.js</h3>             
    </header>

    <section class="about-d3">
    	<div class="row">
	    	<div class="col-md-4 col-md-offset-1">
				<h3>About the Project</h3>
				<!-- <hr class="light left"> -->
				<p>I came accross the D3.js library while building a project for a client where I was to visualise data on the USA map. For esthetics, Alaska and Hawaii had to be closer to the US mainland.</p>
			</div>
			<div class="col-md-5 col-md-offset-1">
				<h3>My role</h3>
				<p>As a contract web developer I was to build an intractive map that visualises data.</p>
			</div>
		</div>
    </section>
	<section class="d3-section">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<p>The D3.js JavaScript library has endless possibilities when visualising data. The AlbersUSA D3.js library was perfect for visualising this GeoJSON data rich project.<br><br> 

				The main challenge with this project was resizing the states to fit with the brief the UX designer gave me. There is not much documentation on how to do this. In the end I downloaded the library files to the project and changed the size and location coordinates of Alaska and Hawaii myself. You can read my blog post about it <a href="https://medium.com/@amyru1/changing-d3js-albersusa-state-size-de4a6687334d#.f5qs6o3a7">here.</a><br><br> Below are the code snippets of the library that I changed. As you can see it is the sections creting rotation, scale and coordinate position.</p>
				
				<script src="https://gist.github.com/amyru/55f20c28e3b6458c00336e98c151ce28.js"></script>
			</div>
		</div>

		<div class="before-after">
			<div class="row">
				<div class=" col-md-6 text-center">
					<h3>AlbersUsa</h3>
				</div>
		    	<div class="col-md-6 text-center">
		    		<h3>After the change</h3>
		    	</div>
		   	</div>
	    	<div class="row">
		    	<div class="col-md-6">
		    		<img class="afterAlbers" src="img/albers.png">
				</div>
				<div class="col-md-6">
					<img class="afterAlbers" src="img/d3jsback.png">
				</div>
			</div>
		</div>
    </section>

	<section class="d3-section">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<p>The whole map is created using layers of data and assigning color to the coordinates. Even the list of state names is positioned with coordinates.</p>
				<script src="https://gist.github.com/amyru/cfbad4f8f44601a51ab0eb3a959a2a5d.js"></script>
			</div>
		</div>
	</section>

	<script>
      var w = 1300;
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

    </script>
    

<?php include('inc/footer.php'); ?>