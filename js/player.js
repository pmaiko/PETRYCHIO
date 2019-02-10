  var mute = false;
    var volume = 100;
    var vol;
    var Song;
    var handle;
    var id_song
    var duration;
    var nameSong;
    var time;
    var linking;
    var globalsrc;
    var max_songs;
    function setVolume(volume) {
         console.log(volume);
         Song.volume = volume/100;
     }
     function getRandom(max,min) {
               return Math.random() * (max - min) + min;
          }
       function next(){
            max_songs = $(".post").attr('id');
            id_song--;
            if (id_song < 1){
                id_song=max_songs;
            }
            $(".post").each(function() {
                var z = $(this).attr("id");
                if (id_song == z){
                    globalsrc = $(this).attr("data-video-src");
                    nameSong = $(this).text();
                    playPause(globalsrc,nameSong);
                    $(".list-play").css("color","white");
                    $(".list-play",this).css("color","#72e6cf");
                }
            });
        }
        function prev(){
            max_songs = $(".content").attr('id');
            id_song++;
            if (id_song > max_songs){
                id_song=max_songs;
            }
            $(".post").each(function() {
                var z = $(this).attr("id");
                if (id_song == z){
                    globalsrc = $(this).attr("data-video-src");
                    nameSong = $(this).text();
                    playPause(globalsrc,nameSong);
                    $(".list-play").css("color","white");
                    $(".list-play",this).css("color","#72e6cf");
                }
            });

        }

    function playSong(src, nameSong){
        var currentTime, current = -100;

        $(".player .nameSong").text(nameSong)
        Song = new Audio(src);
        Song.play();
        linking = src;
        Song.muted = mute;
        setVolume(volume);

        Song.addEventListener('timeupdate',function(){
            duration = Song.duration;
            currentTime = Song.currentTime;
            current =-((duration-currentTime)*100)/duration;
            var timesec = parseInt(currentTime%60);
            var peremena;
            if (timesec < 10){
                peremena = "0";
            }
            else{
                peremena = "";
            }
            $('.time').text(parseInt(currentTime/60)+':'+peremena+parseInt(currentTime%60));
            $(".progress").css({"left":current+"%"});
            //console.log(current);
            if ($('.repeat').hasClass("click")){
                if (currentTime == duration){
                    currentTime = 0;
                    Song.play();
                }
            }
            if (currentTime == duration){
                clearInterval(handle);
                next();
            }
        })

    }
    function playPause(src, nameSong){
        if (Song){
            if(linking==src){
                if (Song.paused){
                    Song.play();
                }
                else{
                    Song.pause();
                }
            }
            else{
                Song.pause();
                playSong(src, nameSong);
            }
        }
        else{
            playSong(src, nameSong);
        }

        if(!Song.paused){
                handle = setInterval(function() {
                    $(".ev1").css("height", getRandom(120, 3));
                    $(".ev2").css("height", getRandom(120, 3));
                    $(".ev3").css("height", getRandom(120, 3));
                    $(".ev4").css("height", getRandom(120, 3));
                    $(".ev5").css("height", getRandom(120, 3));
                    $(".ev6").css("height", getRandom(120, 3));
                    $(".ev7").css("height", getRandom(120, 3));
                    $(".ev8").css("height", getRandom(120, 3));
                    $(".ev9").css("height", getRandom(120, 3));
                    $(".ev10").css("height", getRandom(120, 3));
                    $(".ev11").css("height", getRandom(120, 3));
                    $(".ev12").css("height", getRandom(120, 3));
                    $(".ev13").css("height", getRandom(120, 3));
                    $(".ev14").css("height", getRandom(120, 3));
                    $(".ev15").css("height", getRandom(120, 3));
                    $(".ev16").css("height", getRandom(120, 3));
                    $(".ev17").css("height", getRandom(120, 3));
                    $(".ev18").css("height", getRandom(120, 3));
                    $(".ev19").css("height", getRandom(120, 3));
                    $(".ev20").css("height", getRandom(120, 3));
                    $(".ev21").css("height", getRandom(120, 3));
                    $(".ev22").css("height", getRandom(120, 3));
                    $(".ev23").css("height", getRandom(120, 3));
                    $(".ev24").css("height", getRandom(120, 3));
                    $(".ev25").css("height", getRandom(120, 3));
                    $(".ev26").css("height", getRandom(120, 3));
                    $(".ev27").css("height", getRandom(120, 3));
                    $(".ev28").css("height", getRandom(120, 3));
                    $(".ev29").css("height", getRandom(120, 3));
                    $(".ev30").css("height", getRandom(120, 3));

                }, 70);
            }
            else{
                clearInterval(handle);
            }
    }
    $(document).ready(function(){
        $('#button').click(function(){
            $("input[type='file']").trigger('click');
        })

        $("input[type='file']").change(function(){
            $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
        })

        $(".post").click(function() {
            clearInterval(handle);
           var src = $(this).attr("data-video-src");
           var id = $(this).attr('id');
           var cla = $(this).attr('class');
           id_song=id;
           //$(".delete").attr('name', id)
           nameSong = $(this).text();
           globalsrc = src;
           //$(".aud").attr("src", src);
           //interesting
           //$(this).find(".subclass").css("visibility","visible");
           playPause(globalsrc, nameSong);
           $(".play-pause").css("display","none");
            $(".pause").css("display","flex");
           $(".list-play").css("color","white");
            if (src==globalsrc){
                $(".list-play",this).css("color","#72e6cf");
            }

        });

        $(".play-pause").click(function() {
            if (!Song){
                var max=$(".content").attr('id');
                $(".post").each(function(){
                    var idd = $(this).attr('id');
                    var srcc = $(this).attr("data-video-src");
                    nameSong = $(this).text();
                    if (idd == max){
                        id_song=idd;
                        globalsrc = srcc;
                        playPause(srcc,nameSong);
                        $(".list-play").css("color","white");
                        if (srcc==globalsrc){
                            $(".list-play",this).css("color","#72e6cf");
                        }
                    }
                });
                $(".play-pause").css("display","none");
                $(".pause").css("display","flex");
            }
            else{
                clearInterval(handle);
                playPause(globalsrc);
                $(".play-pause").css("display","none");
                $(".pause").css("display","flex");
            }
        });
        $(".pause").click(function() {
            clearInterval(handle);
            playPause(globalsrc, nameSong);
            $(".play-pause").css("display","flex");
            $(".pause").css("display","none");
        });

        $(".next").click(function(event) {
            clearInterval(handle);
            next();
        });

        $(".prev").click(function(event) {
            clearInterval(handle);
            prev();
        });
        $(".repeat").click(function(event) {
            if (Song){
               $(this).toggleClass("click");
            }

        });
        $(".mute").click(function() {
            if(Song){
                if(mute == false){
                    mute = true;
                    $(".mute").css("color", "#383a4c");
                    $(".volume").val(0);
                }
                else{
                    mute = false;
                    $(".mute").css("color", "white");
                    $(".volume").val(volume);
                }

                 Song.muted = mute;
            }
        });
        $(".volume").change(function(event) {
            if(Song){
                volume = $(".volume").val();
                vol = volume/100;
                Song.volume = vol;
                if (volume ==0){
                    $(".mute").css("color", "#383a4c");
                    mute = true;
                    Song.muted = mute;
                }
                else{
                    $(".mute").css("color", "white");
                    mute = false;
                    Song.muted = mute;
                }
            }
        });
        $(".range").mouseenter(function(event) {
            if(Song){
                var offset =$(this).offset();
                var dur = duration;
                var w = $(this).width();
                $(".range").mousemove(function(event) {
                    var x = event.pageX-offset.left;
                    var xproc = (x*100)/w;
                    var sec = (xproc*dur)/100;
                    xproc = xproc-100;
                    $(".setTime").show();
                    //$(".progress").css('left',xproc+'%');
                    $(".setTime").css('left',x-15);
                    var timesec = parseInt(sec%60);
                    var peremena;
                    if (timesec < 10){
                        peremena = "0";
                    }
                    else{
                        peremena = "";
                    }
                    $('.setTime').text(parseInt(sec/60)+':'+peremena+parseInt(sec%60));
                    $('.range').click(function(){
                        $('.progress').css('left',xproc+'%');
                        Song.currentTime = sec;
                    })

                });
            }
            $('.range').mouseout(function(event) {
                $(".setTime").hide();
            });
        });

    });
    function func() {
  //alert( 'Привет' );
}

setTimeout(func, 1000);
function beforeee(){
    $(".overlay").css("display","block");
}
function seccessdata(data){
    var max=$(".content").attr('id');
    $(".content").each(function(){
        var z = $(this).attr("id");
     if (z == data){
        $(this).remove();
    }
    });


    var i=max;
    $(".content").each(function(){
        $(this).attr("id",i=i-1);
    });
    var i=max;
    $(".post").each(function(){
        $(this).attr("id",i=i-1);
    });
    var i=max;
    $(".delete").each(function(){
        $(this).attr("id",i=i-1);
    });
//$(".list").load("music.php .content");
 $(".overlay").css("display","none");
}

$(".list-wrap").on('click', '.delete', function (event) {
    var src = $(this).attr("data-video-src");
    var id = $(this).attr('id');
    $.ajax({
        url: "delete.php",
        type: "POST",
         dataType : "html",
        data: ({id: id, src: src}),
        beforeSend: beforeee,
        success: seccessdata
    });
});
var playerheight = $(".player").height();
console.log(playerheight);
$(window).scroll(function (){
    var width = $("html,body").scrollTop();
    if (width>playerheight){
        $('.player').addClass("scroll");
        $('.panel').css("display","none");
        $("body").css("margin-top",playerheight);
        $(".timetobar").css("height",8);
        $(".setTime").css("opacity","0");

    }
    else {
        $(".player").removeClass("scroll")
        $('.panel').css("display","flex");
        $("body").css("margin-top",0);
        $(".timetobar").css("height",35);
        $(".setTime").css("opacity","1");
    }
    console.log(width)
});

$("#add").click(function () {
    $(".form-add").css("display","block");
    $(".over").css("display","block");
    $("body").css("overflow","hidden");
});
$(".close").click(function () {
    $(".form-add").css("display","none");
    $(".over").css("display","none");
    $("body").css("overflow","inherit");
});
function update(){
    $(".list-wrap").load("music.php .list");
    $(".overlay").css("display","none");
    $(".form-add").css("display","none");
    $(".over").css("display","none");
}
//$(".addMusic").click(function () {
   // var name = $("input[name='name']").val();
    //var link = $("input[name='link']").val();
   // $.ajax({
     //   url: "add.php",
       // type: "GET",
       // dataType : "html",
        //data: ({name: name, link: link}),
        //beforeSend: beforeee,
        //success: update,
    //})
//});
