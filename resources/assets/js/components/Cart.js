export default class Cart {

    constructor() {

        /* УСТАНОВКА ПЕРЕМЕННЫХ */

        this.simpleMenuCart = $('#fixed-menu .cart');
        this.mobileMenuCart = $('#fixed-menu-mobile .cart')

        this.cartAmount = $('.cart-amount');
        this.cartCost = $('.cart-cost');
        this.cartCostOld = $('.cart-cost-old');

        this.movingCart = $('#cart_add-icon');

        this.buttonSubmit = $('#cart-form_submit');

        this.cartPriceValue = parseInt($('.endprice .cart-cost').text());
        this.cartOldPriceValue = parseInt($('.endprice .cart-cost-old').text());
        this.cartDeliveryDiscount = 0;
        this.cartPromoDiscount = 0;





        /* СОБЫТИЯ */

        let that = this;

        $('.cart-regulator').click(function (e) {
            event.preventDefault(); 
            that._cartMove(e, that, this);
        });

        $('.cart_add-item').click(function(){
            that.addItem(this, that);
        });

        $('.cart_plus-item').click(function(){
            that.plusItem(this, that);
        });

        $('.cart_minus-item').click(function(){
            that.minusItem(this, that);
        });
        $('.cart_remove-item').click(function(){
            that.removeItem(this, that);
        });




        // Установка стоимости товара на первый ценовой элемент
        $('#item .price-container .price-elem.clickable:first-child').addClass('active');
        $('.item .price-container .price-elem.clickable:first-child').addClass('active');

        // Переключение стоимости товара по клику
        $('#item .price-container .price-elem.clickable').click(function () {
            that._itemCostChange(this);
        });
        $('.item .price-container .price-elem.clickable').click(function () {
            that._itemCostChange(this);
        });

        this._orderLowCostCheck();

        

    }



    /* МЕТОДЫ */

    
    // Проверка на количество товаров в корзине
    cartCheck() {

        let that = this;
        
        $.ajax({
            url: '/cart/check',
            method: 'POST',
            success: function (res) {

                that.simpleMenuCart.addClass('disabled');
                that.mobileMenuCart.addClass('disabled');
                that.cartAmount.text(res['cart amount']);
                that.cartCost.text(res['cart cost']);
                that.cartCostOld.text(res['cart cost old']);
                if (res['cart amount'] > 0) {
                    that.simpleMenuCart.removeClass('disabled');
                    that.mobileMenuCart.removeClass('disabled');
                } else {
                    that.buttonSubmit.attr("disabled", true);
                }
                if (res['cart cost old'] == res['cart cost']) {
                    $('.endprice-regulator.crossed').remove();
                }

                that._orderLowCostCheck();

                that.cartPriceValue = res['cart cost'];
                that.cartOldPriceValue = res['cart cost old'];
                that.reloadPrice();

            },
            error: function (msg) {
                console.log(msg);
            }

        });
    };

    





    

    // Обновить стоимость внутри корзины
    reloadPrice() {
        let newCartPrice = this.cartPriceValue - (this.cartPriceValue / 100 * this.cartDeliveryDiscount)
        newCartPrice = newCartPrice - ( newCartPrice / 100 * this.cartPromoDiscount);
        $('.endprice .cart-cost').text(Math.round(newCartPrice));
    }









    // Добавить товар
    addItem(elem, that) {
        
        let attributes = that._getItemAttribute(elem);

        dataLayer.push({
            'event': 'addToCart',
            'ecommerce': {
                'currencyCode': 'UAH',
                'add': {
                    'products': [{
                        'name': attributes['itemTitle'],
                        'id': attributes['itemID'],
                        'price': attributes['itemPrice'],
                        'category': attributes['itemCategory'],
                        'quantity': 1
                    }]
                }
            }
        });

        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                item: attributes['itemID'],
                itemChoice: attributes['itemChoice']
            },
            success: function (res) {
                attributes['itemAmount'].text(res['amount']);
                that.cartCheck();
            },
            error: function (msg) {
                console.log(msg);
            }

        });
    }








    
    // Плюсавать товар
    plusItem(elem, that) {

        let attributes = that._getItemAttribute(elem);

        dataLayer.push({
            'event': 'addToCart',
            'ecommerce': {
                'currencyCode': 'UAH',
                'add': {
                    'products': [{
                        'name': attributes['itemTitle'],
                        'id': attributes['itemID'],
                        'price': attributes['itemPrice'],
                        'category': attributes['itemCategory'],
                        'quantity': 1
                    }]
                }
            }
        });

        $.ajax({
            url: '/cart/plus',
            method: 'POST',
            data: {
                item: attributes['itemID'],
                itemChoice: attributes['itemChoice']
            },
            success: function (res) {
                attributes['itemAmount'].text(res['amount']);
                that.cartCheck();
            },
            error: function (msg) {
                console.log(msg);
            }

        });
    }

    







        
    // Минусовать товар
    minusItem(elem, that) {
        
        let attributes = that._getItemAttribute(elem);

        dataLayer.push({
            'event': 'removeFromCart',
            'ecommerce': {
                'remove': {
                    'products': [{
                        'name': attributes['itemTitle'],
                        'id': attributes['itemID'],
                        'price': attributes['itemPrice'],
                        'category': attributes['itemCategory'],
                        'quantity': 1
                    }]
                }
            }
        });

        $.ajax({
            url: '/cart/minus',
            method: 'POST',
            data: {
                item: attributes['itemID'],
                itemChoice: attributes['itemChoice']
            },
            success: function (res) {

                attributes['itemAmount'].text(res['amount']);
                that.cartCheck();
                
                if (res['amount'] < 1) {
                    if(attributes['item'].hasClass('cart-page-button') === true){
                        attributes['itemLi'].slideUp(200);
                    }
                    
                }
            },
            error: function (msg) {
                console.log(msg);
            }

        });
    }








    // Удалить товар
    removeItem(elem, that) {
        
        let attributes = that._getItemAttribute(elem);

        dataLayer.push({
            'event': 'deleteFromCart',
            'ecommerce': {
                'remove': {
                    'products': [{
                        'name': attributes['itemTitle'],
                        'id': attributes['itemID'],
                        'price': attributes['itemPrice'],
                        'category': attributes['itemCategory'],
                        'quantity': 9999
                    }]
                }
            }
        });

        $.ajax({
            url: '/cart/remove',
            method: 'POST',
            data: {
                item: attributes['itemID'],
                itemChoice: attributes['itemChoice']
            },
            success: function (res) {
                attributes['itemAmount'].text(res['amount']);
                that.cartCheck();
                if(attributes['item'].hasClass('cart-page-button') === true){
                    attributes['itemLi'].slideUp(200);
                }
            },
            error: function (msg) {
                console.log(msg);
            }

        });
    }









    // Получить аттрибуты товара
    _getItemAttribute(elem) {
        
        let itemLi = $(elem).parents('li');

        let attributes = {
            item: $(elem),
            itemLi: $(elem).parents('li'),
            itemAmount: $(itemLi).find('.item-amount'),
            itemID: $(elem).attr('item-id'),
            itemChoice: $(elem).attr('item-choice'),
            itemTitle: $(elem).attr('item-title'),
            itemCategory: $(elem).attr('item-category-id'),
            itemPrice: $(elem).attr('item-price')
        }


        return attributes;
    }








    // Движение товара с карточки в корзину
    _cartMove(e, that, elem) {
        let X = e.clientX;
        let Y = e.clientY;
        let cartX;
        let cartY;


        if ($(elem).hasClass('cart_add-item')) {

            cartX = 90 + '%';
            cartY = 5 + '%';


            that.movingCart.css({
                'left': X - 15 + 'px',
                'top': Y - 15 + 'px',
                'display': 'block'
            });
            that.mobileMenuCart.addClass('movingCartAnimation');
            that.simpleMenuCart.addClass('movingCartAnimation');
            that.movingCart.animate({
                top: cartY,
                left: cartX
            }, 500, function () {
                that.movingCart.css({
                    'display': 'none'
                });
                that.mobileMenuCart.removeClass('movingCartAnimation');
                that.simpleMenuCart.removeClass('movingCartAnimation');
            })

        } else {
            that.mobileMenuCart.addClass('movingCartAnimation');
            that.simpleMenuCart.addClass('movingCartAnimation');

            setTimeout(function () {
                that.mobileMenuCart.removeClass('movingCartAnimation');
                that.simpleMenuCart.removeClass('movingCartAnimation');
            }, 500);

        }
    }










    // Переключение стоимости товара
    _itemCostChange(elem) {
        event.preventDefault();


        let checkOnItemPage = $('#item').length;


        if(checkOnItemPage > 0){
            let parent = $(elem).closest('#item');
            let children = parent.find('.price-elem');
            let cartButton = parent.find('.cart_add-item');
            let choiceID = $(elem).attr('choice-id');
            parent.attr('item-choice', choiceID);
            cartButton.attr('item-choice', choiceID);
            children.removeClass('active');
        }else{
            let parent = $(elem).closest('.item');
            let children = parent.find('.price-elem');
            let cartButton = parent.find('.cart_add-item');
            let choiceID = $(elem).attr('choice-id');
            parent.attr('item-choice', choiceID);
            cartButton.attr('item-choice', choiceID);
            children.removeClass('active');
        }
        
        
        
        $(elem).addClass('active');
    }










    // Проверка на минимальную стоимость заказа
    _orderLowCostCheck() {

        if (this.cartCost.text() > 150) {
            this.buttonSubmit.removeClass('disable');
            this.buttonSubmit.addClass('active');
            $('#cart .low-cost-error').css({
                'display': 'none'
            });
        } else {
            this.buttonSubmit.addClass('disable');
            this.buttonSubmit.removeClass('active');
            $('#cart .low-cost-error').css({
                'display': 'block'
            });
        }
    }



    
    
    
    














    

}


let cart = new Cart();
cart.reloadPrice();
export default cart;
