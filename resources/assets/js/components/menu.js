import Overlay from './Overlay.js';
import SimpleMenu from './SimpleMenu.js';
import MobileMenu from './MobileMenu.js';


let overlay = new Overlay();
let simpleMenu = new SimpleMenu();
let mobileMenu = new MobileMenu();



$(document).ready(function () {



    /* ОВЕРЛЕЙ */

    // Закрытие всего по клику на оверлей
    overlay.block.click(function () {
        mobileMenu.hideList();
        overlay.hide();
    });






    /* МОБИЛЬНОЕ МЕНЮ */

    // Открытие-закрытие мобильного меню-листа
    mobileMenu.switcher.click(function () {
        if (mobileMenu.openStatus === false) {
            mobileMenu.showList();
            overlay.show();
        } else {
            mobileMenu.hideList();
            overlay.hide();
        }
    });

    // Закрытие меню по клику на ссылки-якоря
    mobileMenu.hideWithScroll.click(function () {
        mobileMenu.hideList();
        overlay.hide();
    })

    // Если есть основное меню, то при скролле открыть мобильное меню (обновление при прокрученной странице)
    let currentScrolled = window.pageYOffset || document.documentElement.scrollTop
    if (simpleMenu.check === false) {
        if (currentScrolled > 600 && document.body.clientWidth >= 850) {
            simpleMenu.show();
        } else {
            simpleMenu.hide();
        }
    } else {
        simpleMenu.show();
    }

    // Выдвижение-задвижение меню при скролле
    $(window).scroll(function () {
        let scrolled = window.pageYOffset || document.documentElement.scrollTop;

        if (simpleMenu.check === false) {
            if (scrolled > 600 && document.body.clientWidth >= 850) {
                simpleMenu.show();
            } else {
                simpleMenu.hide();
            }

        } else {
            simpleMenu.show();
        }
    });

    // Выдвижение-задвижение меню при ресайзе
    $(window).resize(function () {
        let scrolled = window.pageYOffset || document.documentElement.scrollTop;
        if (simpleMenu.check === false) {
            if (scrolled > 600 && document.body.clientWidth >= 850) {
                simpleMenu.show();
            } else {
                simpleMenu.hide();
            }
        } else {
            simpleMenu.show();
        }
    });


});