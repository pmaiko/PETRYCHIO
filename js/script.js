$(document).ready(function(){
    $(".post").click( function() {
        var src = $(this).attr("data-video-src");
        $(".aud").attr("src", src);
    })
});
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        slidespeed: 2000,
        items: 1,
        nav: true,
        animateIn: 'rollIn',
        animateOut: 'rollOut',
        mouseDrag: false,
        navText:["",""]
    });
});
$('.owl-carousel--content').slick({
    centerMode: true,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 6000,
    prevArrow:'<div class="btn-prev"><span><</span></div>',
    nextArrow:'<div class="btn-next"><span>></span></div>',
    variableWidth: true,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                centerMode: true,
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                slidesToShow: 1
            }
        }
    ]
});

$(".button-menu").on('click',function(e){
    e.preventDefault;
    $(this).toggleClass('active-menu');
    if ($(this).hasClass('active-menu')) {
        $(".links").css('height', '360px');
        $(".links").css('opacity', '1');
        $(".links").addClass('cl');
        $(".top-menu").addClass('scroll');
        $(".links").css('background-color', '#fff');
    }
    else {
        $(".links").css('height', '0px');
        if ($(window).scrollTop()<600){
            $(".top-menu").removeClass('scroll');
        }
        $(".links").removeClass('cl');
        $(".links").css('opacity', '0');
        $(".links").css('background-color', 'transparent');

    }
    if ($('.links').hasClass('cl')) {
        $(".links").css('opacity', '1');
    }
    else {
        $(".links").css('opacity', '0');
    }
});


$(window).on('scroll',function(){
    if ($(window).scrollTop()>600){
        $(".top-menu").addClass('scroll');
    }
    else {
        $(".top-menu").removeClass('scroll');
    }

    if ($(".button-menu").hasClass('active-menu')) {
        $(".top-menu").addClass('scroll')
    }
})



