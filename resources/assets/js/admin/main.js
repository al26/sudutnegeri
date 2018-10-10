// $.noConflict();

$(document).ready(function() {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	$('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	// $('.user-area> a').on('click', function(event) {
	// 	event.preventDefault();
	// 	event.stopPropagation();
	// 	$('.user-menu').parent().removeClass('open');
	// 	$('.user-menu').parent().toggleClass('open');
	// });
});

isNumberKey = function(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

previewImgUpload = function (input, def, loader, prev, label) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function() {
			if($(def).is(":visible")) {
				$(def).hide(100);
			}
			if($(prev).is(":visible")) {
				$(prev).hide(100);
			}
		}

		reader.onprogress = function(data) {
			$(loader).show(100);
			var timer = 2;
			var x = setInterval(function(){
				timer--;

				if(timer <= 0) {
					clearInterval(x);
					$(loader).hide(100);
					$(prev).attr('src', reader.result);
					$(prev).show(100);
					$(label).text(input.files[0].name);
				}
			}, 1000);
		}

		reader.readAsDataURL(input.files[0]);
	}
}