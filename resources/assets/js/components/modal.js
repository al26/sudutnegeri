(function($) {
    $.fn.loadModal = function() {        
        $("#modal").on("show.bs.modal", function(e) {
            $(".modal-body").empty();
            var url     = $(e.relatedTarget).attr('href'),
                md      = $('.modal-dialog');
                data    = $(e.relatedTarget).data('modal');

                console.log(data);
                data['modal'] = true,
                // data['pjax-reload'] = '#mr';

            $(".modal-title").text(data['title']);

            md.removeClass('modal-lg');
            if(data['lg']) {
                md.addClass('modal-lg');
            }

            if(url) {
                $.get(url, function( content ) {
                    $(".modal-body").html(content);
                }).fail(function(response) {
                    console.log(response);
                });
            } else {
                $(".modal-body").html(data['text']);
            }

            generateBtn(data);
        });
    }

    function generateBtn(data) {
        resetBtn();

        if(data['delete']) {
            $("#mbtn-delete").on('click', function(e){
                e.preventDefault();
                deleteData(data);
            });
            $("#mbtn-delete").html("<i class='far fw fa-trash-alt'></i> " + data['delete']);
            $("#mbtn-delete").show(100);
        }

        if(data['add']) {
            $('#mbtn-add').on('click', function(e){
                e.preventDefault();
                doSubmit(data, $('#modal form'));
            });
            $("#mbtn-add").html("<i class='fas fa-plus fw'></i> " + data['add']);
            $("#mbtn-add").show(100);
        }

        if(data['edit']) {
            $('#mbtn-edit').on('click', function(e){
                e.preventDefault();
                doSubmit(data, $('#modal form'));
            });
            $("#mbtn-edit").html("<i class='far fa-edit fw'></i> " + data['edit']);
            $("#mbtn-edit").show(100);
        }

        if(data['yes']) {
            $('#mbtn-yes').on('click', function(e){
                e.preventDefault();
                yesnoSubmit(data['yesUrl'], data, 'yes');
            });

            $("#mbtn-yes").html("<i class='fas fa-check'></i> " + data['yes']);
            $("#mbtn-yes").show(100);
        }

        if(data['no']) {
            $('#mbtn-no').on('click', function(e){
                e.preventDefault();
                yesnoSubmit(data['noUrl'], data, 'no');
            });
            $("#mbtn-no").html("<i class='fas fa-times'></i> " + data['no']);
            $("#mbtn-no").show(100);
        }

        if(data['cancel']) {
            $("#mbtn-cancel").html("<i class='far fa-window-close'></i> " + data['cancel']);
            $("#mbtn-cancel").show(100);
        }
    }

    function resetBtn() {
        $.each($(".mbtn"), function() {
            $(this).hide(100);
        });
    }

    function doSubmit(data, form) {
        var form    = form,
            action  = data['actionUrl'],
            value   = form.serialize();

        $.ajax({
            url : action,
            type: "POST",
            data: new FormData(form[0]),
            contentType : false,
            processData : false,
            success: function(response) {
                if(response.errors) {
                    resetFeedback();
                    getFeedback(response.errors);

                } 

                if(response.error) {
                    swal({
                        type: 'error',
                        title: response.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

                if(response.success) {
                    if(data['pjax-reload']) {
                        $.each(data['pjax-reload'], function(index, val){
                            $.pjax.reload(val);
                        })
                    }

                    if(data['modal']) {
                        $('#modal').modal('hide');
                    }

                    swal({
                        type: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    if(data['redirectAfter']){
                        // redireload(data['redirectAfter'], data['pjax-reload']);
                        // $.pjax({
                        //     url: data['redirectAfter'], 
                        //     container: data['pjax-reload'][]
                        // });
                        $.each(data['pjax-reload'], function(index, val){
                            $.pjax({
                                url : data['redirectAfter'],
                                container : val,
                            });
                        })
                    }

                    if(data['pchange']) {
                        pchange(data['pchange-url']);
                    }
                }
            },
            error: function(response){
                console.log(response);
                swal({
                    type: 'error',
                    title: 'Oops, Terjadi kesalahan !',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function pchange(url) {
        var split = url.split("/");
            baseurl = split[0] + '//' + split[2] + '/';

        $.get(url, function(response){
            console.log("img src : " + baseurl + response);
            $(".pchange").attr('src', baseurl + response);
        });
    }

    function getFeedback(errors) {
        // var inputs = $('input:not([type="submit"]), textarea, select');

        $.each(errors, function(index, value){
            $('#'+index).parent().append('<div class="invalid-feedback d-block">'+value+'</div>');
            $('#'+index).addClass('is-invalid');
        });

        // console.log(errors);
    }

    function resetFeedback(){
        var inputs = $('input:not([type="submit"]), textarea, select');
        $.each(inputs, function(){
            $(this).siblings('.invalid-feedback').remove();
            $(this).removeClass('is-invalid');
        });
    }

    function deleteData(data){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: data['actionUrl'],
            type: "POST",
            data: {'_method' : 'DELETE', '_token': csrf_token},
            success: function(response) {
                if(response.success) {
                    if(data['modal']) {
                        $('#modal').modal('hide');
                    }
                    swal({
                        type: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $.pjax({url:data['redirectAfter'], container:data['pjax-container']})
                }

                if(response.errors) {
                    if(data['modal']) {
                        $('#modal').modal('hide');
                    }
                    swal({
                        type: 'success',
                        title: response.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                
            }
        })
    }

    function yesnoSubmit(url, data, type){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: url,
            type: "POST",
            data: {'_method' : 'PUT', '_token': csrf_token},
            cache: false,
            ifModified: true,
            global: false
        }).done(function(response) {
            if(response.success) {
                if(data['modal']) {
                    $('#modal').modal('hide');
                }
                
                if (type == 'yes') {
                    swal({
                        type: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    swal({
                        type: 'error',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

                $.pjax({url:data['redirectAfter'], container:data['pjax-container']});
                
            }

            if(response.errors) {
                if(data['modal']) {
                    $('#modal').modal('hide');
                }
                swal({
                    type: 'success',
                    title: response.error,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            $('#mbtn-yes').off();
            $('#mbtn-no').off();
        }).fail(function(response){
            console.log(response);
        })
    }
    
    $.fn.activateCKEditor = function() {
        $("#modal").on("shown.bs.modal", function(e) {
            // $('.the-summernote').summernote();
            ClassicEditor
            .create( document.querySelector('.editor') )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        });
    }

    $.fn.getLocation = function(id, url) {
        $('#'+id).select2({
            theme: "bootstrap4",
            tags: true, 
            // dropdownParent: $('#modal'),
            ajax: {
                url: url,
                type: "POST",
                dataType: "json",
                delay:250,
                data: function(params) {
                    return {
                        key : params.term,
                        _token : $('meta[name="csrf-token"]').attr('content'),
                    };
                },

                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data.items, function(val, index){
                            return {id:val, text:val};
                        })
                    }
                }, 
            },
        });
    }

    $.fn.ajaxSelect2 = function(id, url) {
        $('#'+id).select2({
            theme: "bootstrap4",
            tags: false, 
            // dropdownParent: $('#modal'),
            ajax: {
                url: url,
                type: "POST",
                dataType: "json",
                delay:250,
                data: function(params) {
                    return {
                        key : params.term,
                        _token : $('meta[name="csrf-token"]').attr('content'),
                    };
                },

                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data.items, function(val, index){
                            return {id:val.id, text:val.name};
                        })
                    }
                }, 
            },
        });
    }

    $.fn.ajaxSelect2Modal = function(id, url) {
        $("#modal").on("shown.bs.modal", function(e) {
            $('#'+id).select2({
                theme: "bootstrap4",
                tags: true, 
                dropdownParent: $('#modal'),
                ajax: {
                    url: url,
                    type: "POST",
                    dataType: "json",
                    delay:250,
                    data: function(params) {
                        return {
                            key : params.term,
                            _token : $('meta[name="csrf-token"]').attr('content'),
                        };
                    },

                    processResults: function(data) {
                        console.log(data);
                        return {
                            results: $.map(data.items, function(val, index){
                                return {id:val, text:val};
                            })
                        }
                    }, 
                },
            });
        });
    }

    $.fn.ajaxCrudNonModal = function(pjax = null, redirectAfter = null) {
        var form = $(this),
            data = {
                "actionUrl" : form.attr('action'),
                "pjax-reload" : pjax,
                "redirectAfter" : redirectAfter
            };
            
        doSubmit(data, form);
    }

    function redireload(url, container) {
        window.history.pushState("", "", url);
        $.ajax({
            url : url  
        }).done(function (data) {
            $.pjax.reload(container);
        }).fail(function () {
            alert('An error occured');
        });
    }

}(jQuery));