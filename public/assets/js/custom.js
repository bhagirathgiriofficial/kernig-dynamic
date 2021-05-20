// menu js open
(function($) {
    "use strict";

    //Animation

    $(document).ready(function() {
        $("body.hero-anime").removeClass("hero-anime");
    });

    //Menu On Hover

    $("body").on("mouseenter mouseleave", ".nav-item", function(e) {
        if ($(window).width() > 750) {
            var _d = $(e.target).closest(".nav-item");
            _d.addClass("show");
            setTimeout(function() {
                _d[_d.is(":hover") ? "addClass" : "removeClass"]("show");
            }, 1);
        }
    });

    //Switch light/dark
})(jQuery);
// menu js close

// scroll js open

jQuery(function($) {
    function fixDiv() {
        var $cache = $(".right-sidebar");
        if ($(window).scrollTop() > 100 && $(window).scrollTop() < 2100)
            $cache.css({
                position: "fixed",
                top: "10px"
            });
        else if ($(window).scrollTop() > 1788) {
            $cache.css({
                position: "absolute",
                top: 1788
            });
        } else {
            $cache.css({
                position: "absolute",
                top: "-23.5%"
            });
        }
    }
    $(window).scroll(fixDiv);
    fixDiv();
});
// scroll js close