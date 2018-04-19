$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function(){
    $(window).scroll(function(){
      if($(this).scrollTop() >= 100){
          $('#scroll').fadeIn();
      }else{
          $('#scroll').fadeOut();
      }

	  $('#main-nav').toggleClass('scrolled', $(this).scrollTop() > 50);
	  $('#filter-nav').toggleClass('fixed', $(this).scrollTop() >= 150);
	//   $('#myTab').toggleClass('fixed', $(this).scrollTop() >= 50);
	//   $('#sticky--').toggleClass('fixed', $(this).scrollTop() >= 50);

	  
	//   $('#v-project-nav').toggleClass('fixed', $(this).scrollTop() >= 150);
    });

    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

    // Owl carousel plugin
	var owl = $('.owl-carousel');
	owl.owlCarousel({
		margin: 5,
		dots: false,
		loop: false,
	    responsive:{
	        0:{
	            items:1,
	        },
	        600:{
	            items:2,
	        },            
	        900:{
	            items:3,
	        },
	        1200:{
	            items: 4,
	        },
	        2000:{
	            items: 4,
	        }
	    }
	});

	// Custom Navigation Events
	$(".oc-next").click(function(){
		owl.trigger('next.owl.carousel');
	});
	$(".oc-prev").click(function(){
		owl.trigger('prev.owl.carousel');
	});
});