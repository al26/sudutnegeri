(function($) {
    $.fn.loadModal = function() {
        $("#modal").on("show.bs.modal", function(e) {
            $(".modal-body").empty();
            var url     = $(e.relatedTarget).attr('href'),
                md      = $('.modal-dialog');
                data    = $(e.relatedTarget).data('modal');
            // console.log(data);
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
            $("#mbtn-delete").attr('href', data['actionUrl']);
            $("#mbtn-delete").html("<i class='far fw fa-trash-alt'></i> " + data['delete']);
            $("#mbtn-delete").show(100);
        }

        if(data['add']) {
            $('#mbtn-add').on('click', function(e){
                e.preventDefault();
                doSubmit(data);
            });
            $("#mbtn-add").html("<i class='fas fa-plus fw'></i> " + data['add']);
            $("#mbtn-add").show(100);
        }

        if(data['edit']) {
            $('#mbtn-edit').on('click', function(e){
                e.preventDefault();
                doSubmit(data);
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

    function doSubmit(data) {
        var form    = $('#modal form'),
            action  = data['actionUrl'],
            data    = form.serialize();
        
        $.ajax({
            url : action,
            type: "POST",
            data: data,
            success: function(data) {
                $('#modal').modal('hide');
                $.pjax.reload('#mr')
            },
            error: function(response){
                alert(response);
            }
        });
    }

    $.fn.activeteSummernote = function() {
        $("#modal").on("shown.bs.modal", function(e) {
            $('.the-summernote').summernote();
        });
    }
}(jQuery));