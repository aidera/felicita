/* ОВЕРЛЕЙ */
export default class Overlay {

    constructor() {

        /* ПЕРЕМЕННЫЕ */
        this.block = $('#overlay');
        this.openStatus = false;

    }


    
    /* МЕТОДЫ */

    hide() {
        this.block.animate({
            opacity: 0
        }, 300, function () {
            $(this).css({
                'display': 'none'
            });
        });
        this.openStatus = false;
    }

    show() {
        this.block.css({
            'display': 'block'
        });
        this.block.animate({
            opacity: 0.5
        }, 300);
        this.openStatus = true;
    }

}
