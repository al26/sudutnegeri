(function($) {
    $.fn.ajaxPagination = function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            
            $(this).parent().siblings().removeClass('active');
            $(this).parent().addClass('active');
            
            window.history.pushState("", "", url);
            $.ajax({
                url : url  
            }).done(function (data) {
                $.pjax.reload('#mr');
            }).fail(function () {
                alert('Articles could not be loaded.');
            });
        });
    }

}(jQuery));