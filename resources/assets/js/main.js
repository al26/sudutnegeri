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
    });

    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    
    // $(window).on('show.bs.modal', function(e){
    //     $('body').css("padding-right", "0");
    // });
});

$(function() {
    $('.selectpicker').selectpicker({
        width: auto,
        mobile: true
    });
});