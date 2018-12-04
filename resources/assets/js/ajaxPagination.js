(function($) {
    $.fn.ajaxPagination = function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            
            $(this).parent().siblings().removeClass('active');
            $(this).parent().addClass('active');
            
            $(this).redireload(url);
            
        });

        $('body').on('click', '.pagination .page-item.active', function(e) {
            e.preventDefault();
        });
    }

    $.fn.redireload = function(url) {
        window.history.pushState("", "", url);
        $.ajax({
            url : url  
        }).done(function (data) {
            $.pjax.reload('#mr');
        }).fail(function () {
            alert('An error occured');
        });
    }

    $.fn.setBackUrl = function() {
        backUrl = document.location.href;
        console.log(backUrl);
    }

    $.fn.getBackUrl = function() {
        console.log(backUrl);
        return backUrl;
    }

}(jQuery));