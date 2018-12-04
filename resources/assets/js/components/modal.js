(function($) {
    $.fn.loadModal = function() {        
        var url = null;
        data = null;
        del_url = null;
        submit_url = null;
        yes_url = null;
        no_url = null;
        $("#modal").on("show.bs.modal", function(e) {
            $(".modal-body").empty();
            
                var md      = $('.modal-dialog');
                md.removeClass('modal-lg');
                
                url     = $(e.relatedTarget).attr('href')
                data    = $(e.relatedTarget).data('modal');
                
                data['modal'] = true;
                $(".modal-title").text(data['title']);
                console.log(data);
    
                if(data['lg']) {
                    md.addClass('modal-lg');
                }
    
                if(url) {
                    $.ajaxSetup({cache:false});
                    $.get(url, function( content ) {
                        submit_url = data['actionUrl'] ? data['actionUrl'] : null;
                        yes_url = data['yesUrl'] ? data['yesUrl'] : null; 
                        no_url = data['noUrl'] ? data['noUrl'] : null; 
                        $(".modal-body").html(content);
                    }).fail(function(response) {
                        console.log(response);
                    });
                } else {
                    del_url = data['actionUrl'];
                    $(".modal-body").html(data['text']);
                }
    
                generateBtn(data);
                e.stopImmediatePropagation();

        });

        $('#modal').on('hidden.bs.modal', function (e) {
            data = null;
            del_url = null;
            submit_url = null;
        })
    }

    function generateBtn(data) {
        resetBtn();

        if(data['delete']) {
            $(document).on('click',"#mbtn-delete", function(e){
                e.preventDefault();
                deleteData(data);
                e.stopImmediatePropagation();
                // loaded = false;
                // data['actionUrl'] = null;
                // return false;
            });
            $("#mbtn-delete").html("<i class='far fw fa-trash-alt'></i> " + data['delete']);
            $("#mbtn-delete").show(100);
        }

        if(data['add']) {
            $(document).on('click','#mbtn-add', function(e){
                e.preventDefault();
                doSubmit(data, $('#modal form'));
                e.stopImmediatePropagation();
                // loaded = false;
                // data['actionUrl'] = null;
                // return false;
            });
            $("#mbtn-add").html("<i class='fas fa-plus fw'></i> " + data['add']);
            $("#mbtn-add").show(100);
        }

        if(data['edit']) {
            $(document).on('click','#mbtn-edit', function(e){
                e.preventDefault();
                doSubmit(data, $('#modal form'));
                // loaded = false;
                // data['actionUrl'] = null;
                e.stopImmediatePropagation();
                // return false;
            });
            $("#mbtn-edit").html("<i class='far fa-edit fw'></i> " + data['edit']);
            $("#mbtn-edit").show(100);
        }

        if(data['yes']) {
            $("#modal").on('click','#mbtn-yes', function(e){
                e.preventDefault();
                yesnoSubmit(yes_url, data, 'yes');
                e.stopImmediatePropagation();
                // window.location.href = data['redirectAfter'];
            });

            $("#mbtn-yes").html("<i class='fas fa-check'></i> " + data['yes']);
            $("#mbtn-yes").show(100);
        }

        if(data['no']) {
            $("#modal").on('click','#mbtn-no', function(e){
                e.preventDefault();
                yesnoSubmit(no_url, data, 'no');
                e.stopImmediatePropagation();
                // window.location.href = data['redirectAfter'];
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
        // if (data['actionUrl'] == null) {
        //     return false;
        // }
        // $.ajaxSetup ({
        //     cache: false
        // });
        var form    = form,
            action  = submit_url,
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

                    console.log(response.errors);
                    return false;
                } 

                if(response.error) {
                    swal({
                        type: 'error',
                        title: response.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    return false;
                }

                if(response.success) {
                    resetFeedback();
                    // if(data['pjax-reload']) {
                    //     $.each(data['pjax-reload'], function(index, val){
                    //         $.pjax.reload(val);
                    //     })
                    // }

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
                    return false;
                }
                return false;
            },
            error: function(response){
                console.log(response);
                swal({
                    type: 'error',
                    title: 'Oops, Terjadi kesalahan !',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }
        });

        // loaded = false;
    }

    function pchange(url) {
        if (url == null) {
            return;
        }
        var split = url.split("/");
            baseurl = split[0] + '//' + split[2] + '/';
        $.ajaxSetup ({
            cache: false
        });
        $.get(url, function(response){
            console.log("img src : " + baseurl + response);
            $(".pchange").attr('src', baseurl + response);
        });
    }

    function getFeedback(errors) {
        // var inputs = $('input:not([type="submit"]), textarea, select');

        $.each(errors, function(index, value){
            var sp = index.split(".");
            if(sp.length > 0) {
                index = sp[0];
            }
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
        // if (data['actionUrl'] == null) {
        //     return;
        // }
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        // $.ajaxSetup ({
        //     cache: false
        // });
        $.ajax({
            url: del_url,
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
                return;
            }, 
            error: function(response){
                console.log(response);
                swal({
                    type: 'error',
                    title: 'Oops, Terjadi kesalahan !',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        });

        
    }

    function yesSubmit(url, data) {
        if (url == null) {return;}

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
                swal({
                    type: 'success',
                    title: response.success,
                    showConfirmButton: false,
                    timer: 1500
                });
                
                $.pjax({url:data['redirectAfter'], container:data['pjax-container']});
            }

            if(response.errors) {
                if(data['modal']) {
                    $('#modal').modal('hide');
                }
                swal({
                    type: 'error',
                    title: response.error,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            $('#mbtn-yes').off();
            $('#mbtn-no').off();
            return false;

        }).fail(function(response){
            console.log(response);
            return false;
        });
    }

    function noSubmit(url, data) {
        if (url == null) {return;}

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
                swal({
                    type: 'success',
                    title: response.success,
                    showConfirmButton: false,
                    timer: 1500
                });
                
                $.pjax({url:data['redirectAfter'], container:data['pjax-container']});
            }

            if(response.errors) {
                if(data['modal']) {
                    $('#modal').modal('hide');
                }
                swal({
                    type: 'error',
                    title: response.error,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            $('#mbtn-yes').off();
            $('#mbtn-no').off();
            return false;
        }).fail(function(response){
            console.log(response);
            return false;
        });
    }

    function yesnoSubmit(url, data, type){
        if (url == null) {
            return;
        } else {

            var csrf_token = $('meta[name="csrf-token"]').attr('content'),
            time = new Date().getTime();
            $.ajax({
                url: url,
                type: "POST",
                data: {'_method' : 'PUT', '_token': csrf_token, 'code': type},
                async: false,
                success: function(response) {
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
                        // redireload(data['redirectAfter'],data['pjax-container']);
                        // window.attr.href = data['redirectAfter'];
                        // url = null;
                        // return;
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
                        // return;
                    }
    
                    $('#mbtn-yes').off();
                    $('#mbtn-no').off();
                    return;
                }, error: function(response){
                    console.log(response);
                    return;
                }
            });
            return false;
        }
        
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
        if (url == null) {
            return;
        }
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
        if (url == null) {
            return;
        }
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
        if (url == null) {
            return;
        }
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

    $.fn.ajaxYesNo = function (url, data) {
        if (url == null) {
            return;
        }
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup ({
            cache: false
        });
        $.ajax({
            url: url,
            type: "POST",
            data: {'_method' : 'PUT', '_token': csrf_token},
            cache: false,
            ifModified: true,
            global: false
        }).done(function(response) {
            if(response.success) {
                swal({
                    type: 'success',
                    title: response.success,
                    showConfirmButton: false,
                    timer: 1500
                });
                $.pjax({url:data['redirectAfter'], container:data['pjax-container']});
            }

            if(response.error) {
                swal({
                    type: 'error',
                    title: response.error,
                    showConfirmButton: false,
                    timer: 1500
                });
                $.pjax({url:data['redirectAfter'], container:data['pjax-container']});
            }
            return;

        }).fail(function(response){
            console.log(response);
            return;
        });
        
    }

}(jQuery));