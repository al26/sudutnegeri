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
    });

    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

    // Owl carousel plugin
	var owl = $('.owl-carousel');
	owl.owlCarousel({
	    margin: 5,
	    responsive:{
	        0:{
	            items:1,
	            dots: false,
			    loop: false,
	        },
	        600:{
	            items:2,
	            dots: false,
	            loop: false,
	        },            
	        900:{
	            items:3,
	            loop: false,
			    dots: true
	        },
	        1200:{
	            items: 4,
	            loop: false,
			    dots: true
	        },
	        2000:{
	            items: 4,
	            loop: false,
			    dots: true
	        }
	    }
	});

});