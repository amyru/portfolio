<?php include("inc/header.php"); ?>

	<header class="travel-top">
        <div class="header-content">
            <div class="travel header-content-inner">
               <img class='travel-head-image img-responsive' src="img/iphonephoto.png">
                
            </div>
        </div>
    </header>

    <section class="about-travel">
    	<div class="row">
	    	<div class="col-md-10 col-md-offset-1">
				<h3>About the Project</h3>
				<!-- <hr class="light left"> -->
				<p>After first discovering my love for Ruby and Rails I wanted to build a web app to display my travel photos. I used the devise gem to create an admin section and saved the uploaded images to Amazon S3. The image grid is using the masonry gem, making it automatically responsive to screen size.</p>
			</div>
		</div>

    </section>

    <section class="travel-photo">
		<img class="img-responsive" src="img/photopage.png">
		<br><br>
    	<h3 class="text-center">Masonry Gem at work here...</h3>
    	<br><br>
    	<div class="col-md-10 col-md-offset-1">
			<p>An automatic grid was neccessary here so I could freely upload photos and not have to worry about resizing and placing them each time. The Masonry Ruby Gem creates a grid, taking the size of the screen into account.<br><br>I chose three images max per row as not to overpower the viewer.<br><br>I had some great experiences travelling around the world and getting to know so many different cultures. I am glad I have a space to reflect on those memories.<br><br>(below: Paris, a penguine in Cape Town, Mekong Delta Vietnam.)</p> 
    </section>

    <section class="text-center">
		<img class="img-responsive photo-examples" src="img/photo.png">
    </section>

<?php include('inc/next-page.php'); ?>
<?php include('inc/footer.php'); ?>