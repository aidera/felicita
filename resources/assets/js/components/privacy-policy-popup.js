import getCookie from '../functions/getCookie';



class PrivacyPolicyPopup {
    constructor() {

        /* ПЕРЕМЕННЫЕ */
        this.block = $('#agreement-popup');
        this.closeElem = $('.close_agreement-popup');
        this.cookie = getCookie("agreementpopup");


        let that = this;

        /* СОБЫТИЯ */
        this.closeElem.click(function () {
            that.hide();
        })

        if (that.cookie != 'hide') {
            that.open();
        }
        

    }

    /* МЕТОДЫ */


    // Открытие
    open() {
        let that = this;

        setTimeout(function(){
            that.block.css({
                'display': 'block'
            });
            that.block.animate({
                opacity: 1
            }, 300);
        }, 5000);

    }

    

    // Закрытие
    hide() {
        let that = this;

        that.block.animate({
            opacity: 0,
            left: '-500px'
        }, 300, function () {
            that.block.css({
                'display': 'none'
            });
        });
        document.cookie = "agreementpopup=hide";
    }
        
        
}

let privacyPolicyPopup = new PrivacyPolicyPopup();
