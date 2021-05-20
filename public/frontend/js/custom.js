$(document).ready(function () { 
    $('#kitchan_slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        // dots:false,
        autoplay:true,
        autoplayTimeout:1200,
        autoplayHoverPause:true,
        responsive: {
            0: {
                items: 1
            }
        }
    });
    $('#logos_slider').owlCarousel({ 
        loop:true,
        margin:10,
        nav: true,
        items: 6,
        dots: false,
        autoplay:true,
        autoplayTimeout:1200,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 3,
                center:true,
            },
            767:{
                items: 6
            }
        }
    })
    // $("a[data-theme]").click(function () {
    //     $("head link#theme").attr("href", $(this).data("theme"));
    //     $(this).toggleClass('active').siblings().removeClass('active');
    // });
    $("a[data-effect]").click(function () {
        $("head link#effect").attr("href", $(this).data("effect"));
        $(this).toggleClass('active').siblings().removeClass('active');
    });
})