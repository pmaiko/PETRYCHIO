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
function readysex(data){
    $(".load").html(data);
    $(".overlay").css("display","none");
}
function before(){
    $(".overlay").css("display","block");
}
$('#load_more').click(function () {
    var id;
    var cat;
    $('.elm').each(function () {
         id = $(this).attr('id');
    });
    $('.eml4-button').each(function () {
        cat = $(this).attr('id');
        if ($(this).hasClass('active')){
            $.ajax({
                url:"app/post_images.php",
                type: "post",
                dataType: "html",
                data: ({limit:id, cat:cat}),
                beforeSend: before,
                success: readysex
            });
        }
    });
});
$("#all_photo").click(function () {
    event.preventDefault();
    $(this).addClass('active');
    $('#cat1').removeClass('active');
    $("#cat2").removeClass('active');
    $("#cat3").removeClass('active');
    $("#cat4").removeClass('active');
    $.ajax({
        url:"app/post_images.php",
        type: "post",
        dataType: "html",
        data: ({limit:0}),
        beforeSend: before,
        success: readysex
    });
});
$("#cat1").click(function () {
    event.preventDefault();
    $(this).addClass('active');
    $("#all_photo").removeClass('active');
    $("#cat2").removeClass('active');
    $("#cat3").removeClass('active');
    $("#cat4").removeClass('active');
    $.ajax({
        url:"app/post_images.php",
        type: "post",
        dataType: "html",
        data: ({limit:0,cat:'cat1'}),
        beforeSend: before,
        success: readysex
    });
});
$("#cat2").click(function () {
    event.preventDefault();
    $(this).addClass('active');
    $("#all_photo").removeClass('active');
    $("#cat1").removeClass('active');
    $("#cat3").removeClass('active');
    $("#cat4").removeClass('active');
    $.ajax({
        url:"app/post_images.php",
        type: "post",
        dataType: "html",
        data: ({limit:0,cat:'cat2'}),
        beforeSend: before,
        success: readysex
    });
});
$("#cat3").click(function () {
    event.preventDefault();
    $(this).addClass('active');
    $("#all_photo").removeClass('active');
    $("#cat1").removeClass('active');
    $("#cat2").removeClass('active');
    $("#cat4").removeClass('active');
    $.ajax({
        url:"app/post_images.php",
        type: "post",
        dataType: "html",
        data: ({limit:0,cat:'cat3'}),
        beforeSend: before,
        success: readysex
    });
});
$("#cat4").click(function () {
    event.preventDefault();
    $(this).addClass('active');
    $("#all_photo").removeClass('active');
    $("#cat1").removeClass('active');
    $("#cat2").removeClass('active');
    $("#cat3").removeClass('active');
    $.ajax({
        url:"app/post_images.php",
        type: "post",
        dataType: "html",
        data: ({limit:0,cat:'cat4'}),
        beforeSend: before,
        success: readysex
    });
});
var X;
var Y;
$(window).mousemove(function(e){
    X = e.pageX;
    Y = e.pageY - $(window).scrollTop();
    console.log("X: " + X + " Y: " + Y);
});
$('.load').on('click', '.elm', function (event) {
    var src = $('img',this).attr('src');
    $('.my-modal images').attr('src',src);
    $('.my-modal').css('left', X+'px');
    $('.my-modal').css('top', Y+'px');
    $('.my-modal').css('display','flex');
    $('body').css('overflow','hidden');
    $('.modal-images').delay(1500).fadeIn();
    $('.my-modal').addClass('transition_over');
    $('.my-modal').removeClass('transition_overback');
});
$('.closed').click(function () {
    //$('.my-modal').css('display','none');
    $('body').css('overflow','auto');
   // $('.modal-images').fadeOut();
    $('.my-modal').removeClass('transition_over');
    $('.my-modal').addClass('transition_overback');

});

$(window).scroll(function () {
    var num  = $(this).scrollTop();
    console.log($(window).height()  );
    if(num < $(window).height() && $(window).height() >= 600){
        $('.header').css({
            "transform" : "translateY("+num+"px"+")"
        });
    }
});

