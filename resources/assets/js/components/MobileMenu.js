/* МОБИЛЬНОЕ МЕНЮ */
export default class MobileMenu {

    constructor() {
        

        /* ПЕРЕМЕННЫЕ */
        this.switcher = $('.fixed-menu-mobile_switcher');
        this.list = $('#fixed-menu-mobile_list');
        this.openStatus = false;

        this.list1 = $('#fixed-menu-mobile_list .menu-list');
        this.listDropDown = $('#fixed-menu-mobile_list .drop-down > a');
        this.listDropDownBack = $('#fixed-menu-mobile_list .drop-down .back');
        this.hideWithScroll = $('#fixed-menu-mobile_list .scrollto');



        /* СОБЫТИЯ */
        // Открытие подменю
        let that = this;
        this.listDropDown.click(function() {
            that.showDropDown();
        });
        // Закрытие подменю
        this.listDropDownBack.click(function(){
            that.hideDropDown();
        });


    }

    /* МЕТОДЫ */
    showList() {
        this.list.css({
            'display': 'block'
        });
        this.list.animate({
            left: 0
        }, 300);
        this.openStatus = true;
    }

    hideList() {
        this.list.animate({
            left: -300
        }, 300, function () {
            $(this).css({
                'display': 'none'
            });
        });
        this.openStatus = false;
    }

    showDropDown() {
        this.listDropDown.parent('li').children('ul').css({
            'display': 'block'
        });
        this.list1.css({
            'margin-left': '-1000px'
        });
    }

    hideDropDown() {
        this.listDropDownBack.parent('ul.undermenu').css({
            'display': 'none'
        });
        this.list1.css({
            'margin-left': '0px'
        });
    }

}

