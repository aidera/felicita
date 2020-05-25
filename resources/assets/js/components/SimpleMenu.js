/* ОБЫЧНОЕ МЕНЮ */
export default class SimpleMenu {

    constructor() {

        /* ПЕРЕМЕННЫЕ */
        this.check = $('.general-image').length <= 0;
        this.block = $('#fixed-menu');
    }


    /* МЕТОДЫ */

    show() {
        this.block.css({
            "top": "0"
        });
    }

    hide() {
        this.block.css({
            "top": "-" + 200 + "px"
        });
    }



}

