import lang from '../functions/langDefinitions';
import cart from '../components/Cart';




// Проверка чекбокса на "Ближайшее время?"
$('.block_deliver-time-choose').css({
    'display': 'none'
});
$('#cart-form_input_deliver-time_switcher').click(function () {
    if ($(this).find('input').val() !== 'true') {
        $('.block_deliver-time-choose').slideDown();
    } else {
        $('.block_deliver-time-choose').slideUp();
    }
});



// Тип доставки
let cartDeliveryCostBlock = $('#item-info .delivery .delivery-cost');
let cartBlockAddress = $('.block-address');
let cartBlockAddressSelf = $('.block-address-self');

$('.choose-delivery_regulator').click(function () {
    cartBlockAddress.css({
        'display': 'none',
        'opacity': 0
    });
    cartBlockAddressSelf.css({
        'display': 'none',
        'opacity': 0
    });


    if ($(this).val() == 'deliver') {

        cartBlockAddress.css({
            'display': 'block'
        });
        cartBlockAddress.animate({
            opacity: 1
        }, 300);

        if(lang == 'ru'){
            cartDeliveryCostBlock.text('БЕСПЛАТНО');
        }else{
            cartDeliveryCostBlock.text('БЕЗКОШТОВНО');
        }
        

        cartDeliveryCostBlock.animate({
            opacity: 1
        }, 300);

        cart.cartDeliveryDiscount = 0;

    } else if ($(this).val() == 'self') {

        cartBlockAddressSelf.css({
            'display': 'block'
        });
        cartBlockAddressSelf.animate({
            opacity: 1
        }, 300);

        if(lang == 'ru'){
            cartDeliveryCostBlock.text('самовывоз - СКИДКА 10%');
        }else{
            cartDeliveryCostBlock.text('самовивіз - ЗНИЖКА 10%');
        }

        cart.cartDeliveryDiscount = 10;
    }

    cart.reloadPrice();

});






// Обновление промокода
function reloadPromo(type, num) {
    //Тип 1 = скидка в процентах
    if (type == 1) {
        if(lang == 'ru'){
            $('#cart .promo .promo-cost').text('СКИДКА - '+num+'%');
        }else{
            $('#cart .promo .promo-cost').text('ЗНИЖКА - '+num+'%');
        }

        cart.cartPromoDiscount = num;
        
    } else {
        if(lang == 'ru'){
            $('#cart .promo .promo-cost').text('СКИДКА - 0%');
        }else{
            $('#cart .promo .promo-cost').text('ЗНИЖКА - 0%');
        }

        cart.cartPromoDiscount = 0;
    }


}
reloadPromo(0,0);



// Активация промокода
$('#cart-form_input_promo').keyup(function () {

    // Получаем текущее значение в поле ввода
    let promoValue = $('#cart-form_input_promo').val();
    promoValue = promoValue.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_-]/g, "");
    promoValue = promoValue.toLowerCase();

    // Поиск текущего значения
    $.ajax({
        url: '/promocode/check',
        method: 'POST',
        data: {
            promo: promoValue,
        },
        success: function (res) {
            if (res != 0) {
                reloadPromo(res.type, res.number);

            } else {
                reloadPromo(0, 0);
            }
            cart.reloadPrice();

        },
        error: function (msg) {
            console.log(msg);
        }
    });



});






// Заявка
$('#cart-form_submit').click(function () {

    if ($(this).hasClass('disable')) {
        let scrollToDestinationLowCost = $('#anchor-low-cost').offset().top;
        $("html:not(:animated),body:not(:animated)").stop().animate({
            scrollTop: scrollToDestinationLowCost - 300 + 'px'
        }, 1100, "swing");
    } else {
        $('#cart-form_submit').css({
            'display': 'none'
        });
        $('.submit-loader').css({
            'display': 'block'
        });
        $('.error-message').text('');

        // Итоговая стоимость
        let normalCost = $('.endprice .cart-cost').text();
        normalCost = normalCost.replace(/[^0-9_.,-]/g, "");
        let promoCost = $('.endprice .promo-newprice').text();
        promoCost = promoCost.replace(/[^0-9_.,-]/g, "");
        let totalCost = normalCost;
        if (promoCost != '' && promoCost != null) {
            totalCost = promoCost;
        }

        // Имя
        $('#cart-form_input_name').css({
            'border-color': '#FBB03B'
        });
        let userName = $('#cart-form_input_name').val();
        userName = userName.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., -]/g, "");
        let userNameCheck = false;
        if (userName != '') {
            userNameCheck = true;
        }



        // Телефон
        $('#cart-form_input_phone').css({
            'border-color': '#FBB03B'
        });
        let userPhone = $('#cart-form_input_phone').val();
        userPhone = userPhone.replace(/[^0-9_()+-]/g, "");
        let userPhoneCheck = false;
        if (userPhone != '') {
            userPhoneCheck = true;
        }

        // Email
        // $('#cart-form_input_email').css({'border-color':'#FBB03B'});
        let userEmail = $('#cart-form_input_email').val();
        userEmail = userEmail.replace(/[^A-Za-zА-Яа-яЁё0-9_@.-]/g, "");
        // let userEmailCheck = false;
        // if(userEmail != '' && userEmail.indexOf('@') >=0 && userEmail.indexOf('.') >=0 ){
        //   userEmailCheck = true;
        // }
        let userEmailCheck = true;

        // Тип доставки
        let userDeliveryType = $('input.choose-delivery_regulator:checked').val();
        userDeliveryType = userDeliveryType.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., -]/g, "");

        // Улица
        $('#cart-form_input_address-street').css({
            'border-color': '#FBB03B'
        });
        let userStreet = $('#cart-form_input_address-street').val();
        userStreet = userStreet.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., -]/g, "");
        let userStreetCheck = false;
        if (userStreet != '') {
            userStreetCheck = true;
        }

        // Дом
        $('#cart-form_input_address-house').css({
            'border-color': '#FBB03B'
        });
        let userHouse = $('#cart-form_input_address-house').val();
        userHouse = userHouse.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., -]/g, "");
        let userHouseCheck = false;
        if (userHouse != '') {
            userHouseCheck = true;
        }

        // Этаж
        let userFlor = $('#cart-form_input_address-flor').val();
        userFlor = userFlor.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., -]/g, "");

        // Помещение
        let userFlat = $('#cart-form_input_address-flat').val();
        userFlat = userFlat.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., -]/g, "");

        // В ближайшее время
        let userSoon = $('#cart-form_input_deliver-time_switcher_input').val();
        userSoon = userSoon.replace(/[^A-Za-zА-Яа-яЁё0ІіЄє'Її0-9_., -]/g, "");

        // День доставки
        let userDate = $('#cart-form_input_deliver-date').val();
        userDate = userDate.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_., :-]/g, "");

        // Время доставки
        let userTime = $('#cart-form_input_deliver-time').val();
        userTime = userTime.replace(/[^A-Za-zА-Яа-яЁё0-9_.,:-]/g, "");

        // Промокод
        let userPromo = $('#cart-form_input_promo').val();
        userPromo = userPromo.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9_-]/g, "");
        userPromo = userPromo.toLowerCase();

        // Комментарий
        let userComment = $('#cart-form_input_comment').val();
        userComment = userComment.replace(/[^A-Za-zА-Яа-яЁёІіЄє'Її0-9 _.,?!:-]/g, "");




        if (userNameCheck === false ||
            userPhoneCheck === false ||
            userEmailCheck === false) {

            let message = '';

            if (lang == 'ru') {
                message = 'Пожалуйста, правильно заполните обязательные поля';
            } else {
                message = "Будь ласка, правильно заповніть обов'язкові поля";
            }


            if (userNameCheck === false) {
                $('#cart-form_input_name').css({
                    'border-color': 'red'
                });
            }
            if (userPhoneCheck === false) {
                $('#cart-form_input_phone').css({
                    'border-color': 'red'
                });
            }

            if (userDeliveryType === 'deliver') {
                if (userStreetCheck === false) {
                    $('#cart-form_input_address-street').css({
                        'border-color': 'red'
                    });
                }
                if (userHouseCheck === false) {
                    $('#cart-form_input_address-house').css({
                        'border-color': 'red'
                    });
                }
            }




            $('.error-message').text(message);
            let scrollToDestinationForm = $('#order-info').offset().top;
            $("html:not(:animated),body:not(:animated)").stop().animate({
                scrollTop: scrollToDestinationForm - 100 + 'px'
            }, 1100, "swing");

            $('#cart-form_submit').css({
                'display': 'inline-block'
            });
            $('.submit-loader').css({
                'display': 'none'
            });

        } else {

            if (userDeliveryType === 'self') {
                userStreet = 'Ревуцкого',
                    userHouse = '42в',
                    userFlor = '',
                    userFlat = ''
            }

            $.ajax({
                url: '/order/send',
                method: 'POST',
                data: {
                    cost: totalCost,
                    userName: userName,
                    userPhone: userPhone,
                    userEmail: userEmail,
                    userDeliveryType: userDeliveryType,
                    userStreet: userStreet,
                    userHouse: userHouse,
                    userFlor: userFlor,
                    userFlat: userFlat,
                    userSoon: userSoon,
                    userDate: userDate,
                    userTime: userTime,
                    userPromo: userPromo,
                    userComment: userComment,
                },
                success: function (res) {
                    let userInfo = res[0];
                    let itemsInfo = res[1];
                    let itemsOrderInfo = res[2];
                    console.log(itemsInfo);


                    let transactionTotal = 0;
                    let transactionProducts = [];
                    let transactionProducts2 = [];


                    itemsInfo.forEach(function (item, index) {

                        let quantity = 0;

                        itemsOrderInfo.forEach(function (itemOrderInfo, index) {
                            if (itemOrderInfo['item_id'] == item['id']) {
                                quantity = itemOrderInfo['amount'];
                            }
                        })


                        let currentPrice = 0;
                        let itemPriceArray = item['price'].split(';');
                        transactionTotal += itemPriceArray[itemsOrderInfo['choice_id']] * quantity;
                        currentPrice = itemPriceArray[itemsOrderInfo['choice_id']];



                        transactionProducts.push({
                            'sku': item['id'],
                            'name': item['title-ua'],
                            'category': item['category'],
                            'price': currentPrice,
                            'quantity': quantity
                        })
                        transactionProducts2.push({
                            'id': item['id'],
                            'name': item['title-ua'],
                            'category': item['category'],
                            'price': currentPrice,
                            'quantity': quantity
                        })
                    })



                    dataLayer.push({
                        'event': 'purchase',
                        'ecommerce': {
                            'purchase': {
                                'actionField': {
                                    'id': userInfo.id,
                                    'affiliation': 'FELICITA',
                                    'revenue': transactionTotal,
                                    'tax': 0,
                                    'shipping': 0,
                                    'coupon': ''
                                },
                                'products': transactionProducts2
                            }
                        }
                    });


                    dataLayer.push({
                        'event': 'simple-transaction'
                    });


                    if (lang == 'ru') {
                        window.location.replace("/ru/thankyou");
                    } else {
                        window.location.replace("/ua/thankyou");
                    }
                    // $('#cart-form_submit').css({'display':'inline-block'});
                    // $('.submit-loader').css({'display':'none'});

                },
                error: function (msg) {
                    console.log(msg);

                }

            });
        }




    }





});
