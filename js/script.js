$(document).ready(function(){
<<<<<<< HEAD
    $(".post").click( function() {
        var src = $(this).attr("data-video-src");
        $(".aud").attr("src", src);
    })
});
$(document).ready(function(){
=======
>>>>>>> 3981e46c2fd07c2271660f8e10ed18f04be563b3
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
<<<<<<< HEAD
=======
                arrows: false,
>>>>>>> 3981e46c2fd07c2271660f8e10ed18f04be563b3
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
<<<<<<< HEAD

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

=======
$(document).ready(function(){
    $(".bars_menu").click(function(){
        $(".top-links").slideToggle();
    });
    $(".lightbox").fancybox();

});
$(document).ready(function(){
    $('.contacts_map')
        .click(function(){
            $(this).find('iframe').addClass('clicked')})
        .mouseleave(function(){
            $(this).find('iframe').removeClass('clicked')});
});

$(function(){
    'use strict';
    $('#form').on('submit', function(e){
        e.preventDefault();
        var fd = new FormData( this );
        $.ajax({
            url: 'send.php',
        type: 'POST',
        contentType: false,
            processData: false,
            data: fd,
            success: function(msg){
            if(msg == 'ok') {
               //$(".button").val("Отправлено");
                $("#writeus").modal("hide");
                $("#itOK").modal("show");

            } else {
                $(".button").val("Ошибка");
                setTimeout(function() {$(".button").val("Отправить");}, 3000);
            }
        }
    });
    });
});

$(document).ready(function(){
    $(".top-links").on("click","a", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();
        //забираем идентификатор бока с атрибута href
        var id  = $(this).attr('href'),
        //узнаем высоту от начала страницы до блока на который ссылается якорь
        top = $(id).offset().top;
        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 1500);
    });
});
$("#phone").mask("+7 (999) 999-99-99");
$("#phone").on("blur", function() {
    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

    if( last.length == 7 ) {
        var move = $(this).val().substr( $(this).val().indexOf("-") + 1, 1 );

        var lastfour = last.substr(1,4);
        var first = $(this).val().substr( 0, 9 );

        $(this).val( first + move + '-' + lastfour );
    }
});

function counter(event) {
    var element   = event.target;         // DOM element, in this example .owl-carousel
    var items     = event.item.count;     // Number of items
    var item      = event.item.index + 1;     // Position of the current item
    if (item<=2){
        $(".open__button-elm1").css("display","block")
        $(".open__button-elm2").css("display","none")
    }
    else {
        $(".open__button-elm2").css("display","block")
        $(".open__button-elm1").css("display","none")
    }
}
>>>>>>> 3981e46c2fd07c2271660f8e10ed18f04be563b3
