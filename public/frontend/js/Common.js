 $(window).load(function () {
     $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });    

    $('.owl-carousel').on('changed.owl.carousel',
        function (event) {
            $(this).find('img.lazy').lazyload({
                effect: "fadeIn",
                effectTime: 0
            });
        });
});



/*Phần cố định*/
/*Hàm cho Owlcarousel*/
 function owlslide(num, margin, autoplay, dot, nav, mobile, mobilel, tablet, tabletl, pc, animateIn, animateOut) {
     var option = {
         items: num,
         autoplay: autoplay,
         autoplayTimeout: 5000,
         smartSpeed: 1500,
         loop: num > 1,
         nav: num > pc ? nav : false,
         dots: num > pc ? dot : false,
         autoplayHoverPause: true,
         margin: margin,
         lazyLoad: true,
         navText: [''],
         animateIn: animateIn,
         animateOut: animateOut,
         responsive: {
             0: {
                 items: mobile,
                 margin: margin,
                 autoplay: num > mobile ? autoplay : false,
                 nav: num > mobile ? nav : false,
                 dots: num > mobile ? dot : false,
             },
             479: {
                 items: mobilel,
                 margin: margin,
                 autoplay: num > mobilel ? autoplay : false,
                 nav: num > mobilel ? nav : false,
                 dots: num > mobilel ? dot : false,
             },
             767: {
                 items: tablet,
                 margin: margin,
                 autoplay: num > tablet ? autoplay : false,
                 nav: num > tablet ? nav : false,
                 dots: num > tablet ? dot : false,
             },
             991: {
                 items: tabletl,
                 margin: margin,
                 autoplay: num > tabletl ? autoplay : false,
                 nav: num > tabletl ? nav : false,
                 dots: num > tabletl ? dot : false,
             },
             1199: {
                 items: pc,
                 margin: margin,
                 autoplay: num > pc ? autoplay : false,
                 nav: num > pc ? nav : false,
                 dots: num > pc ? dot : false,
             }
         }
     }
     return option;
 }
/*Hàm cho Owlcarousel*/
$(document).ready(function () {
    $(function () {
        $(window).scroll(function () {
            var windowScrollTop = $(this).scrollTop();
            if (windowScrollTop >= 800) {
                $('#bttop').fadeIn();
            } else {
                $('#bttop').fadeOut();
            }
        });
        $('#bttop').click(function () {
            event.preventDefault();
            $('body,html').animate({ scrollTop: 0 }, 1600);
        });
    }); 
    $(function () {  
        $('.noidung img').attr("data-lightbox", "roadtrip");

        var countimg = 0;
        $('.noidung img').each(function () {
            var src = $(this).attr("src");
            if (!$(this).parent().is("a")) {
                $('<a class="example-image-link countimg' +
                    countimg +
                    '" href="' +
                    src +
                    '" data-lightbox="example-1"></a>').insertBefore($(this));
                $('.countimg' + countimg).append($(this));
            } else {
                var href = $(this).parent("a").attr("href");
                if (href === src)
                    $(this).parent("a").attr({
                        "class": "example-image-link countimg" + countimg,
                        "data-lightbox": "example-1"
                    });
            }
            countimg++;
        });

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        }); 
    }); 
    $('.openList').click(function () { 
        $('#commonHead').toggleClass('active');
        $('.openList').toggleClass('ac');
        //$('#overlay').fadeToggle();
    });
    $('#overlay').click(function () {
        $('#commonHead').toggleClass('ac');
        $('.openList').toggleClass('ac');
        //$('#overlay').fadeToggle(); 
    }); 
    $('.openSub').click(function () {
        $(this).next('ul').slideToggle();
        $(this).toggleClass('ac');
        $(this).parent('li').toggleClass('ac');
    }); 
});
/*end Phần cố định*/


//Bắt định dạng email
function validateEmail(email) {
    var re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email.toLowerCase());
}
 

$(window).resize(function () {
    //$('.dotdotdot').height('auto');
    //$('.dotdotdot').dotdotdot(); 
});
$(document).ready(function () {
    $('#slide').owlCarousel(owlslide($('#slide').find('>*').size(), 10, true, true, false, 1, 1, 1, 1, 1, "fadeIn", "fadeOut"));  
    $('#star .group').owlCarousel(owlslide($('#star .group').find('>*').size(), 25, true, false, true, 2, 3, 3, 4, 4, "", ""));
    $('.product .group.slide3').owlCarousel(owlslide($('.product .group.slide3').find('>*').size(), 0, true, false, true, 2, 3, 4, 4, 4, "", ""));

    var wWindow = $(window).width();
    if (wWindow > 767) {
        $('.product .group.slide').owlCarousel(owlslide($('.product .group.slide').find('>*').size(), 30, true, false, true, 2, 3, 4, 5, 5, "", ""));
        $('.product .group.slide2').owlCarousel(owlslide($('.product .group.slide2').find('>*').size(), 20, true, false, true, 2, 3, 2, 3, 3, "", ""));
    } else {
        $("#footer .titleHead").click(function () {
            if ($(this).hasClass("active")) {
                $("#footer .titleHead").removeClass("active");
                $(this).nextAll().hide();
            } else {
                $("#footer .titleHead ~*").hide();
                $(this).nextAll().fadeToggle();
                $("#footer .titleHead").removeClass("active");
                $(this).addClass("active");
            } 
        });
    }

    if (wWindow <= 1199) {
        $(".otherPro.slideRes .group").owlCarousel(owlslide($('.otherPro.slideRes .group').find('>*').size(), 20, true, false, true, 2, 3, 3, 3, 3, "", ""));
    }

    jQuery('.tabs .tab-links a').on('click',
        function (e) {
            var currentAttrValue = jQuery(this).attr('href');
            jQuery('.tabs ' + currentAttrValue).addClass("active").siblings().removeClass("active");
            jQuery(this).parent('li').addClass('active').siblings().removeClass('active'); 
            e.preventDefault(); 
        });

    $('.openSubOrder').click(function () {
        if (!$(this).hasClass('active')) {
            $('.function .sub').slideUp();
            $('.openSubOrder').removeClass('active');
            $(this).next(".sub").slideDown();
            $(this).addClass('active'); 
        } else {
            $(this).removeClass('active');
            $('.function .sub').slideUp();
        } 
    });
    $('.closeSub').click(function () {
        $('.function .sub').slideUp();
        $('.openSubOrder').removeClass('active');
    });
    $('.product .xemthem').click(function () {
        $(this).parent(".btnXemthem").prev(".group").toggleClass("active");
        $(this).parent(".btnXemthem").addClass("active");
    });
    $('.filterLogo .group .viewMore').click(function () {
        $(this).parents(".group").toggleClass("active");
        $(this).toggleClass("active");
    });

    $('#product .detailPro .imgLarge').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        nextArrow: '<i class="fas fa-chevron-right"></i>',
        prevArrow: '<i class="fas fa-chevron-left"></i>',
        asNavFor: '#product .detailPro .imgSmall',
        lazyLoad: 'ondemand',
    });
    $('#product .detailPro .imgSmall').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        asNavFor: '#product .detailPro .imgLarge',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        nextArrow: '<i class="fas fa-chevron-down"></i>',
        prevArrow: '<i class="fas fa-chevron-up"></i>',
        lazyLoad: 'ondemand',
        vertical: true, 
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    vertical: true,
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    vertical: true,
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 3,
                }
            }
        ]
    });
}); 
