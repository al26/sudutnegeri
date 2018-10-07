$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open')
  });

  $('[data-toggle="search"]').on('click', function () {
    $('.search-collapse').toggleClass('open')
  });

  // $('[data-toggle="filter"]').on('click', function () {
  //   $('.filter-collapse').toggleClass('open')
  // });

});

openNav = function () {
    $('.slide-off').css({'width' : "16rem"});
    $('.so-main').css({'margin-left': '16rem', 'margin-right' : 'auto'});
    // document.getElementById("mySidenav").style.width = "250px";
    // document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
closeNav = function () {
    $('.slide-off').css({'width' : "0"});
    $('.so-main').css({'margin-left': 'auto', 'margin-right' : 'auto'});
  // document.getElementById("mySidenav").style.width = "0";
  // document.getElementById("main").style.marginLeft = "auto";
  // document.getElementById("main").style.marginRight = "auto";
}