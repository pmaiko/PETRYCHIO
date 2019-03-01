<template>
  <div class="main">
    <div class="overlay">
    <div class="loaded">
      <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
      <span class="sr-only">Загрузка...</span>
    </div>
  </div>
    <div class="my-modal">
      <div class="modal-img">
        <div class="closed">
          <span></span>
        </div>
        <img src="" alt="">
      </div>
    </div>
    <div class="top-menu">
      <div class="container">
        <div class="outside">
          <div class="button-menu" @click="openMenu" :class="{'active-menu': activeMenu === true}">
            <span></span>
          </div>
          <div class="logotype">
            <div class="logo"></div>
            <div class="slogan"><a href="#">Petrychio</a></div>
          </div>
          <div class="links">
            <i class="fa fa-car" aria-hidden="true"></i>
            <ul>
              <li><router-link to="/login">Music</router-link></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Portfolio</a></li>
              <li><a href="#">Features</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Pricing</a></li>
              <li><a href="#">Shortcodes</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div class="buttons">
            <ul>
              <li><a href="#" id="a1"></a></li>
              <li><a href="#" id="a2"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <header class="header">
      <carousel :autoplay="true" :nav="true" :items="1" :loop="true"
                :autoplaySpeed="speedSlider = false">
        <div class="header__images1">
          <div class="header__images-overlay"></div>
        </div>
        <div class="header__images2">
          <div class="header__images-overlay"></div>
        </div>
        <div class="header__images3">
          <div class="header__images-overlay"></div>
        </div>
      </carousel>
      <div class="header__content">
        <h2>Kakoy to bespoleznyy tekst</h2>
        <h1>Petryxa Web & App</h1>
        <p>Я разрабатываю и кодирую красиво, и мне нравится то, что я делаю. Web-разработчик / HTML-верстальщик / Программист PHP / JavaScript</p>
        <a href="#" class="header__button">Get Started</a>
      </div>
    </header>
    <section class="eml1">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="eml1-content">
              <div class="eml1-images"><img src="../../assets/images/pansil.png" alt=""></div>
              <h3>Дизайн</h3>
              <p>Я ценю простую структуру контента, чистые шаблоны проектирования и продуманные взаимодействия.</p>
              <div class="eml1-line"></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="eml1-content">
              <div class="eml1-images"><img src="../../assets/images/place.png" alt=""></div>
              <h3>Разработчик</h3>
              <p>Я имею тенденцию кодировать вещи с нуля и наслаждаться реализацией <br> идей в браузере.</p>
              <div class="eml1-line"></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="eml1-content">
              <div class="eml1-images"><img src="../../assets/images/tools.png" alt=""></div>
              <h3>Наставник</h3>
              <p>Я искренне забочусь о людях и люблю помогать новым дизайнерам работать на своем ремесле.</p>
              <div class="eml1-line"></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="eml1-content">
              <div class="eml1-images"><img src="../../assets/images/file.png" alt=""></div>
              <h3>Маркетинг</h3>
              <p>Я создаю, продвигаю, предоставляю и втираю какуе то дич <br> покупателям ...</p>
              <div class="eml1-line"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="eml2">
      <div class="container">
        <h2>Правильное отображение на всех устройствах</h2>
        <p>Портфолио автоматически подстраивается для отображения на смартфонах. Для управления внешним видом веб-сайта на мобильных устройствах можно использовать специальные параметры. </p>
        <div class="eml2-image">
          <img src="../../assets/images/browsers.png" alt="">
        </div>
      </div>
    </section>
    <section class="eml3">
      <div class="container">
        <div class="row">
          <div class="col-md-6 d-flex align-items-lg-start justify-content-center flex-column">
            <h3><span>Waxom</span> Multipurpose WordPress Theme</h3>
            <p>Don't Forget to Rate the Template. Thanks so much!</p>
          </div>
          <div class="col-md-6 d-flex justify-content-end align-items-center">
            <a href="#" class="button"><span class="cl-hover"></span>Purchase Now</a>
          </div>
        </div>
      </div>
    </section>
    <section class="eml4">
      <div class="container d-flex flex-column align-items-center">
        <h2>Our Latest Projects.</h2>
        <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
        <div class="eml4-buttons">
          <a href="#" class="eml4-button active" id="all_photo">All</a>
          <a href="#" class="eml4-button" id="cat1">Kiev</a>
          <a href="#" class="eml4-button" id="cat2">Lviv</a>
          <a href="#" class="eml4-button" id="cat3">Uman</a>
          <a href="#" class="eml4-button" id="cat4">Gaivoron</a>
        </div>
        <div class="row load w-100">
          <?php foreach ($images as $images): ?>
          <div class="col-md-4">
            <div class="elm" id="<?=$images['id'];?>">
              <div class="image">
                <img src="<?=$images['src'];?>" alt="">
              </div>
              <div class="block">
                <div class="arrow"></div>
                <h3><?=$images['caption'];?></h3>
                <p><?=$images['text'];?></p>
              </div>
            </div>
          </div>
          <? endforeach; ?>
        </div>
        <div id="load_more" class="button"><span class="cl-hover"></span>Load More</div>
      </div>
    </section>
    <section class="video">
      <div class="header__images-overlay"></div>
      <div class="content">
        <div class="button-play">
          <div class="play"></div>
        </div>
        <h2>Waxom Video Presentation</h2>
        <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius, qui <br/> sequitur mutationem consuetudium.</p>
        <span>3:26</span>
      </div>
    </section>
    <section class="eml5">
      <div class="container">
        <div class="row">
          <div class="col-md-5 justify-content-end d-flex">
            <div class="images-content"></div>
          </div>
          <div class="col-md-7">
            <div class="content">
              <h2>Excellent for Mobile Devices</h2>
              <p>Qisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius claritas. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
              <div class="list">
                <li><div class="overlay-span"><span></span></div>Nam liber tempor cum soluta nobis eleifend option;</li><br>
                <li><div class="overlay-span"><span></span></div>Option congue nihil imperdiet doming id quod mazim placerat facer;</li><br>
                <li><div class="overlay-span"><span></span></div>Eodem modo typi, qui nunc nobis videntur parum futurum;</li><br>
                <li><div class="overlay-span"><span></span></div>Investigationes demonstraverunt lectores</li><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="eml6">
      <div class="container">
        <div class="row">
          <div class="margin col-md-2 offset-md-1 flex-column align-items-center justify-content-center d-flex">
            <div class="images images-people"></div>
            <div class="numbers">3587</div>
            <div class="text">Satisfied Clients</div>
            <div class="solid"></div>
          </div>
          <div class="margin col-md-2 flex-column align-items-center justify-content-center d-flex">
            <div class="images images-cups"></div>
            <div class="numbers">207</div>
            <div class="text">Cups of coffee</div>
            <div class="solid"></div>
          </div>
          <div class="margin col-md-2 flex-column align-items-center justify-content-center d-flex">
            <div class="images images-comment"></div>
            <div class="numbers">2500</div>
            <div class="text">Blog posts</div>
            <div class="solid"></div>
          </div>
          <div class="margin col-md-2 flex-column align-items-center justify-content-center d-flex">
            <div class="images images-likes"></div>
            <div class="numbers">873</div>
            <div class="text">Likes</div>
            <div class="solid"></div>
          </div>
          <div class="margin col-md-2 flex-column align-items-center justify-content-center d-flex">
            <div class="images images-laun"></div>
            <div class="numbers">900</div>
            <div class="text">We launched</div>
            <div class="solid"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="eml7">
      <div class="container">
        <h2 class="text-center">Recent Posts.</h2>
        <p class="text-center">Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
        <slick class="owl-carousel--content" :options="slickOptions">
          <div class="content">
            <div class="images images-img1">
              <div class="images-overlay"></div>
              <div class="block-top">
                <div class="number">
                  30
                </div>
                <div class="text">
                  Sep.
                </div>
              </div>
            </div>
            <div class="info">
              <h3>Lorem ipsum dolor sit amet</h3>
              <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
              <a href="#">Read More</a>
            </div>
          </div>
          <div class="content">
            <div class="images images-img2">
              <div class="images-overlay"></div>
              <div class="block-top">
                <div class="number">
                  14
                </div>
                <div class="text">
                  Sep.
                </div>
              </div>
            </div>
            <div class="info">
              <h3>Lorem ipsum dolor sit amet</h3>
              <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
              <a href="#">Read More</a>
            </div>
          </div>
          <div class="content">
            <div class="images images-img3">
              <div class="images-overlay"></div>
              <div class="block-top">
                <div class="number">
                  28
                </div>
                <div class="text">
                  Sep.
                </div>
              </div>
            </div>
            <div class="info">
              <h3>Lorem ipsum dolor sit amet</h3>
              <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
              <a href="#">Read More</a>
            </div>
          </div>
          <div class="content">
            <div class="images images-img4">
              <div class="images-overlay"></div>
              <div class="block-top">
                <div class="number">
                  17
                </div>
                <div class="text">
                  Sep.
                </div>
              </div>
            </div>
            <div class="info">
              <h3>Lorem ipsum dolor sit amet</h3>
              <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
              <a href="#">Read More</a>
            </div>
          </div>
          <div class="content">
            <div class="images images-img5">
              <div class="images-overlay"></div>
              <div class="block-top">
                <div class="number">
                  24
                </div>
                <div class="text">
                  Sep.
                </div>
              </div>
            </div>
            <div class="info">
              <h3>Lorem ipsum dolor sit amet</h3>
              <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
              <a href="#">Read More</a>
            </div>
          </div>
          <div class="content">
            <div class="images images-img6">
              <div class="images-overlay"></div>
              <div class="block-top">
                <div class="number">
                  21
                </div>
                <div class="text">
                  Sep.
                </div>
              </div>
            </div>
            <div class="info">
              <h3>Lorem ipsum dolor sit amet</h3>
              <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.</p>
              <a href="#">Read More</a>
            </div>
          </div>
        </slick>
      </div>
    </section>
    <section class="eml8">
      <div class="container">
        <div class="row">
          <div class="margin col-md-3 d-flex justify-content-center align-items-center">
            <div class="images">
              <img src="../../assets/images/logo-01.png" alt="">
            </div>
          </div>
          <div class="margin col-md-3 d-flex justify-content-center align-items-center">
            <div class="images">
              <img src="../../assets/images/logo-02.png" alt="">
            </div>
          </div>
          <div class="margin col-md-3 d-flex justify-content-center align-items-center">
            <div class="images">
              <img src="../../assets/images/logo-03.png" alt="">
            </div>
          </div>
          <div class="margin col-md-3 d-flex justify-content-center align-items-center">
            <div class="images">
              <img src="../../assets/images/logo-04.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="eml9">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="content">
              <div class="logo">
                <div class="image_logo"></div>
                <div class="logo-text">Waxom</div>
              </div>
              <div class="text">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci suscipit lobortis claritatem.</p>
                <a href="#">Read More</a>
              </div>

            </div>
          </div>
          <div class="col-md-3">
            <div class="content">
              <h3>Recent Posts</h3>
              <div class="posts">
                <div class="date">September 08, 2015</div>
                <div class="post">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
              </div>
              <div class="posts">
                <div class="date">September 08, 2015</div>
                <div class="post">Diam nonummy nibh euismod tincidunt ut laoreet dolore magna</div>
              </div>
              <div class="posts">
                <div class="date">September 08, 2015</div>
                <div class="post">Claritas est etiam processus dynamicus, qui sequitur mutationem per seacula quarta decima</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="content">
              <h3>Our Twitter</h3>
              <div class="posts">
                <div class="post post-cus">
                  <span>@waxom</span> Cum soluta nobis eleifend option congue nihil imperdiet doming
                </div>
                <div class="time">3 mins ago</div>
              </div>
              <div class="posts">
                <div class="post post-cus">
                  Mirum est <span>#envato</span> notare quam littera gothica, quam nunc putamus parum anteposuerit litterarum
                </div>
                <div class="time">3 mins ago</div>
              </div>
              <div class="posts">
                <div class="post post-cus">
                  Soluta nobis option <a href="#">bit.ly/1Hniso7</a>
                </div>
                <div class="time">3 mins ago</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="content">
              <h3>Dribbble Widget</h3>
              <div class="images">
                <img src="../../assets/images/f-photo1.png" alt="">
                <img src="../../assets/images/f-photo2.png" alt="">
              </div>
              <div class="images">
                <img src="../../assets/images/f-photo3.png" alt="">
                <img src="../../assets/images/f-photo4.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="content justify-content-start">
              <div class="slogan">Copyright © 2018 <span>PETRYCHIO</span></div> |
              <li><a href="#">Privacy Policy</a></li> |
              <li><a href="#">FAQ</a></li> |
              <li><a href="#">Support</a></li>
            </div>
          </div>
          <div class="col-md-6">
            <div class="content justify-content-end">
              <div class="slogan">Designed by <span>MadeInSamSklupaw</span></div> |
              <div class="slogan">Only on <span>Immortal</span></div>

            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import $ from 'jquery'
import Slick from 'vue-slick'
import carousel from 'vue-owl-carousel'
export default {
    components: {
        Slick,
        carousel,
    },
    data() {
        return {
            speedSlider: 1000,
            slickOptions: {
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
            },
            activeMenu: false,

        };
    },

    methods: {
        openMenu() {
            this.activeMenu = !this.activeMenu;
            if (this.activeMenu === true) {
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
        }
    },
}

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
});

$(window).scroll(function () {
    var num  = $(this).scrollTop();
    if(num < $(window).height() && $(window).height() >= 600){
        $('.header').css({
            "transform" : "translateY("+num+"px"+")"
        });
    }
});


</script>
