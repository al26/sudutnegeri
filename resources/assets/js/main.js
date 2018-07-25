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

    $('.smnt').summernote();
    
    var validateNumericInput = function(selector){
        console.log(selector);
        $(selector).keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl/cmd+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: Ctrl/cmd+C
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: Ctrl/cmd+X
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

    isNumberKey = function(evt){
        console.log('iaoisasa');
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    generateOption = function(triggerElem, targetElem, table, placeholder) {
        $(triggerElem).on('change', function(e){
            var filter_id = e.target.value,
                url = '/json/option/'+table+'?id=' + filter_id;

            $.get(url, function(data){
                $(targetElem).empty();
                $(targetElem).append('<option selected disabled>--Pilih '+placeholder+'--</option>');
                $.each(data, function(index, obj){
                    $(targetElem).append('<option value="'+ obj.id +'">' + obj.name + '</option>')
                });
            })
        })
    }

    handleAgreement = function(checkbox, target) {
        if(checkbox.checked == true){
            $('#'+target).removeAttr("disabled");
            console.log('checked');
        } else{
            $('#'+target).attr("disabled", "disabled");
            console.log('not checked');
        }
    }
});

$.fn.select2.defaults.set( "theme", "bootstrap4" );

$(function() {
    $('.selectpicker').selectpicker({
        mobile: true,
    });

    $('.selectpicker').on( 'hide.bs.select', function ( ) {
        $(this).trigger("focusout");
    });
});

$.pjax.defaults.scrollTo = false;