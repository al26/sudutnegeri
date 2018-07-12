(function($) {
    $.fn.countRemainingTime = function(now, countDownDate, expiryMsg) {
        var container = $(this).data();
        setInterval(function() {
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
        
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
            container.innerHTML = days + " hari";

            if(days <= 0) {
                container.innerHTML = hours + " jam";
            }

            if(days <= 0 && hours <= 0) {
                container.innerHTML = minutes + " menit";
            }

            if(days <= 0 && hours <= 0 && minutes <= 0) {
                container.innerHTML = seconds + " detik";
            }
        
            if (distance < 0) {
                clearInterval(x);
                container.innerHTML = expiryMsg;
            }
        }, 1000);
    }

}(jQuery));