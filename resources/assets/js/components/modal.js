(function($) {
    $.fn.loadModal = function() {
        $("#modal").on("show.bs.modal", function(e) {
            $(".modal-body").empty();
            var url     = $(e.relatedTarget).attr('href'),
                md      = $('.modal-dialog');
                data    = $(e.relatedTarget).data('modal'),
                data['modal'] = true,
                data['pjax-reload'] = '#mr';
            console.log(data);
            $(".modal-title").text(data['title']);

            md.removeClass('modal-lg');
            if(data['lg']) {
                md.addClass('modal-lg');
            }

            if(url) {
                $.get(url, function( content ) {
                    $(".modal-body").html(content);
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

            console.log(form);
        $.ajax({
            url : action,
            type: "POST",
            data: value,
            success: function(response) {
                if(response.errors) {
                    resetFeedback();
                    getFeedback(response.errors);
                    console.log(response.errors);
                } 

                if(response.success) {
                    if(data['pjax-reload']) {
                        $.pjax.reload("#mr");
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
                    console.log(response.success);
                }
            },
            error: function(response){
                // alert(response);
                console.log(response);
            }
        });
    }

    function getFeedback(errors) {
        var inputs = $('input:not([type="submit"]), textarea, select');
        $.each(errors, function(index, value){
            $('#'+index).parent().append('<div class="invalid-feedback">'+value+'</div>');
            $('#'+index).addClass('is-invalid');
        });
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
                    $('#modal').modal('hide');
                    $('#modal').on('hidden.bs.modal', function(){
                        swal({
                            type: 'success',
                            title: response.success,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    });
                    $.pjax({url:data['redirectAfter'], container:data['pjax-container']})
                }

                if(response.errors) {
                    $('#modal').modal('hide');
                    $('#modal').on('hidden.bs.modal', function(){
                        swal({
                            type: 'error',
                            title: response.errors,
                            showConfirmButton: true
                        });
                    });
                }
                
            }
        })
    }
    
    $.fn.activeteSummernote = function() {
        $("#modal").on("shown.bs.modal", function(e) {
            $('.the-summernote').summernote();
        });
    }

    $.fn.activeteSelectPicker = function() {
        $("#modal").on("shown.bs.modal", function(e) {
            $('.selectpicker').selectpicker();
        });
    }

    $.fn.ajaxCrudNonModal = function(pjax = null) {
        var form = $(this),
            data = {
                "actionUrl" : form.attr('action'),
                "pjax-reload" : pjax,
            };
            
            doSubmit(data, form);
    }

}(jQuery));