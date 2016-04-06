$(document).ready(function(){

	// video overlay

	$('.videoWrapper').hide();

	$('.toggle_it').click(function(e){
		e.preventDefault();
		$('.toggle_it').hide();
		$('.videoWrapper').slideToggle();
	})

	$('.ipad').click(function(e){
	  e.preventDefault();
	  $('.toggle_it').slideToggle();
	  $('.videoWrapper').slideToggle();
	})


	//screen width hide div

	$(window).resize(function() {

	  if ($(this).width() < 1024) {

	    $('.exp-block').hide();

	  } else {

	    $('.exp-block').show();

	  }

	});


});

//mute autoplay video for topsecret.php
// var iframe = $('#video')[0];
// // var iframe = document.getElementsByTagName('iframe')[0];
// var player = $f( iframe );
 	
//  player.addEvent('ready', function() {
//      player.api('setVolume', 0); 
//  });
