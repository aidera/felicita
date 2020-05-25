// import Cart from './components/Cart'



/* AJAX-ЗАПРОСЫ */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});







$(document).ready(function () {



    // let cart = new Cart();



    





    /* ПАРАЛАКС */
    let scrolled = window.pageYOffset || document.documentElement.scrollTop;
    //Параллакс картинки в шапке
    $('.general-image > div.img').css({
        "top": 0
    });
    if (document.body.clientWidth > 800) {
        var parallaxGeneralBg = scrolled * 0.4 + 'px';
        $('.general-image > div.img').css({
            "top": parallaxGeneralBg
        });
    }

    //Параллакс картинок background-dishes
    $('.background-dish-left').css({
        "top": 0
    });
    $('.background-dish-right').css({
        "top": 0
    });
    if (document.body.clientWidth > 800) {
        var bgdl = scrolled * 0.3 + 'px';
        $('.background-dish-left').css({
            "top": bgdl
        });
        $('.background-dish-right').css({
            "top": bgdl
        });
    }


    $(window).scroll(function () {
        let scrolled = window.pageYOffset || document.documentElement.scrollTop;

        //Параллакс картинки в шапке
        $('.general-image > div.img').css({
            "top": 0
        });
        if (document.body.clientWidth > 800) {
            var parallaxGeneralBg = scrolled * 0.4 + 'px';
            $('.general-image > div.img').css({
                "top": parallaxGeneralBg
            });
        }

        //Параллакс картинок background-dishes
        $('.background-dish-left').css({
            "top": 0
        });
        $('.background-dish-right').css({
            "top": 0
        });
        if (document.body.clientWidth > 800) {
            var bgdl = scrolled * 0.3 + 'px';
            $('.background-dish-left').css({
                "top": bgdl
            });
            $('.background-dish-right').css({
                "top": bgdl
            });
        }

        
    });










    /* УЛУЧШЕННЫЕ ИНПУТЫ */
    $('.fancy-input input').each(function () {
        if ($(this).val()) {
            $(this).parent('.fancy-input').children("label").addClass('focus');
        }
    })
    $('.fancy-input input').on('focus', function () {
        $(this).parent('.fancy-input').children("label").addClass('focus');
    });
    $('.fancy-input input').on('focusout', function () {
        if ($(this).val() == '') {
            $(this).parent('.fancy-input').children("label").removeClass('focus');
        }

    });





    /* ИМИТАТОР ЧЕКБОКСА */
    $('.switch-btn').each(function () {
        var switchValue = $(this).find('input.hiddeninput').val();
        if (switchValue == 'true') {
            $(this).addClass('switch-on');
        } else {
            $(this).removeClass('switch-on');
        }
    });
    $('.switch-btn').click(function () {
        var switchValue = $(this).find('input.hiddeninput').val();
        if (switchValue == 'true') {
            $(this).removeClass('switch-on');
            $(this).find('input.hiddeninput').val('');
        } else {
            $(this).addClass('switch-on');
            $(this).find('input.hiddeninput').val('true');
        }
    });


    



    /* МАСКА ДЛЯ ТЕЛЕФОНА */
    if ($('.input-phone').length > 0) {
        $('.input-phone').mask('+38 (099) 999-99-99');
    }






    /* ПЛАВНЫЙ СКРОЛЛИНГ */
    $(".scrollto").click(function () {
        let elementClick = $(this).attr("href");
        let destination = $(elementClick).offset().top;
        $("html:not(:animated),body:not(:animated)").stop().animate({
            scrollTop: destination + 'px'
        }, 1100, "swing");
        return false;
    });





    /* ПРЕЛОАДЕР */
    function preloader() {
        $("#preloader").animate({
            opacity: 0
        }, 800, function () {
            $("#preloader").css({
                "display": "none"
            });
        });
    }
    setTimeout(preloader, 500);








    /* МЕНЮ */
    require('./components/menu.js');


    /* PRIVACY POLICY - попап */
    require('./components/privacy-policy-popup.js');


    /* КОРЗИНА - добавление, удаление, минусование */
    require('./components/Cart.js');
    
    
    /* КОРЗИНА - страница */
    require('./pages/cart.js');




    

});