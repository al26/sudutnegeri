$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open')
  });

  $('[data-toggle="search"]').on('click', function () {
    $('.search-collapse').toggleClass('open')
  });

});