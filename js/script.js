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
