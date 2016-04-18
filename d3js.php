<?php include("inc/header.php"); ?>
	<header class="d3-top">
        <div class="map-size">
	        <div id="map"></div>
        </div>
	    <img class="phone" src="img/d3jsback.png"> 
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
			<div class="row text-center">
		    	<div class="col-md-6">
					<h3>AlbersUsa</h3>
		    		<img class="afterAlbers" src="img/albers.png">
				</div>
				<div class="col-md-6">
		    		<h3>After the change</h3>
					<img class="afterAlbers" src="img/d3jsback.png">
				</div>
			</div>
		</div>
    </section>

	<section class="d3-section">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h3 class="text-center">Data becomes Color</h3>
				<hr>
				<p>The whole map is created using layers of data and assigning color to the coordinates. Even the list of state names is positioned with coordinates.</p>
				<script src="https://gist.github.com/amyru/cfbad4f8f44601a51ab0eb3a959a2a5d.js"></script>
			</div>
		</div>
	</section>    

<?php include('inc/footer.php'); ?>