$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function(){
    $('#main-nav').toggleClass('scrolled', $('#main-nav').offset().top >= 50);

    // console.log('initial offset'+$('#main-nav').offset().top);
    $(window).scroll(function(){
      if($(this).scrollTop() >= 100){
          $('#scroll').fadeIn();
      }else{
          $('#scroll').fadeOut();
      }
    //   console.log('after scroll offset'+$('#main-nav').offset().top);
	  $('#main-nav').toggleClass('scrolled', $('#main-nav').offset().top >= 50);
	//   $('#filter-nav').toggleClass('fixed', $(this).scrollTop() >= 150);
    });

    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

    // $('.smnt').summernote();
    
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

    getSearcResult = function(input, targetElem) {
        var key = input.value,
            url = '/json/projects/?key=' + key;

        $.get(url, function(data){
            $(targetElem).empty();
            if(key.length > 0) {
                $.each(data, function(index, obj){               
                    $(targetElem).append('<a href="/project/details/'+obj.project_slug+'"><div class="items"><div class="media"><img class="mr-3" src="http://via.placeholder.com/50x50" alt="Generic placeholder image"><div class="media-body"><h5 class="mt-0">'+obj.project_name+'</h5><i class="fas fa-map-marker-alt"></i> '+obj.project_location+'</div></div></div></a>');
                });

                if(data.length <= 0){
                    $(targetElem).append('<div class="items text-center">Tidak ditemukan proyek dengan kata kunci pencarian <b>'+key+'</b></div>');    
                }

                $(targetElem).append('<a href="/project/browse/all"><div class="items text-center">Semua Proyek</div></a>');
            }
        })
    }

    handleAgreement = function(checkbox, target) {
        if(checkbox.checked == true){
            $('#'+target).removeAttr("disabled");
        } else{
            $('#'+target).attr("disabled", "disabled");
        }
    }

    checkAgreement = function(btn, reference) {
        if($('#'+reference+':checkbox:checked').length > 0) {
            return true;
        } else {
            return false;
        }
    }

    previewImgUpload = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function() {
                if($('#pp-preview-default').is(":visible")) {
                    $('#pp-preview-default').hide(100);
                }
                if($('#pp-preview').is(":visible")) {
                    $('#pp-preview').hide(100);
                }
            }

            reader.onprogress = function(data) {
                $('#pp-loader').show(100);
                var timer = 2;
                var x = setInterval(function(){
                    timer--;

                    if(timer <= 0) {
                        clearInterval(x);
                        $('#pp-loader').hide(100);
                        $('#pp-preview').attr('src', reader.result);
                        $('#pp-preview').show(100);
                        $('.custom-file-label').text(input.files[0].name);
                    }
                }, 1000);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // yesnoSubmit = function(link, redirect = nul, pjax = null){
    //     var csrf_token = $('meta[name="csrf-token"]').attr('content');
            
    //     $.ajax({
    //         url: url,
    //         type: "POST",
    //         data: {'_method' : 'PUT', '_token': csrf_token},
    //         success: function(response) {
    //             if(response.success) {
    //                 $('#modal').modal('hide');
    //                 $('#modal').on('hidden.bs.modal', function(){
    //                     swal({
    //                         type: 'success',
    //                         title: response.success,
    //                         showConfirmButton: false,
    //                         timer: 1500,
    //                     });
    //                 });
    //                 $.pjax({url:redirect, container:pjax})
    //             }

    //             if(response.errors) {
    //                 $('#modal').modal('hide');
    //                 $('#modal').on('hidden.bs.modal', function(){
    //                     swal({
    //                         type: 'error',
    //                         title: response.errors,
    //                         showConfirmButton: true
    //                     });
    //                 });
    //             }
                
    //         }
    //     })
    // }
});

$.fn.select2.defaults.set( "theme", "bootstrap4" );

// $(function() {
//     $('.selectpicker').selectpicker({
//         mobile: true,
//     });

//     $('.selectpicker').on( 'hide.bs.select', function ( ) {
//         $(this).trigger("focusout");
//     });
// });

$.pjax.defaults.scrollTo = false;