if (typeof ltcart == "undefined" || !ltcart) {
    var ltcart = {};
}


ltcart.cart = {

    successMsg: 'Success',
    deleteElementUrl: '',
    updateElementUrl: '',

    cartDeleteBtn: '[data-role="cart-delete-btn"]',
    cartBuyForm: '[data-role="cart-buy-form"]',
    cartCountBtn: '[data-role="cart-count-btn"]',


    init: function () {

        jQuery(document).on('submit', ltcart.cart.cartBuyForm, function (event) { // событие для добавлени товара
            var self = this;
            url = $(self).attr('action');
            data = jQuery(self).serialize();
            var title = $(self).data('title');
            var count =ltcart.cart.countElementsInAdd(self);
            if(count  > 0){

                if(ltcart.cart.addElement(data, url)){
                    ltcart.cart.alert(title + ' x ' +count, 'success', "Добавлено:");
                }

            } else {
                ltcart.cart.alert('Вы не выбрали ни одного товара', 'warning');
            }

            event.preventDefault();
            return false;
        });

        jQuery(document).on('click',ltcart.cart.cartDeleteBtn, function (event) { // событие удаления товара

            ltcart.cart.deleteElement($(this).data('id'), ltcart.cart.deleteElementUrl);
            event.preventDefault();
            return false;
        });

        $(document).on("change", ltcart.cart.cartCountBtn, function () {  // обновить количество
            ltcart.cart.updateCount(this);
        });
    },

    alert: function (message) { // алерт вполняющийся после зпроса
        alert(message);
    },


    addElement: function (data, url) { // обработчик добавления елемента


        return ltcart.cart.sendData(data, url);
       // ltcart.cart.alert(ltcart.cart.successMsg);

    },

    countElementsInAdd: function(form){
        var data = $(form).serializeArray();
        var count = 0;

        data.forEach( function(val) { count+=  Number(val.value) ;  } );
        return count;
    },

    updateCount: function (el) { // обработчик обновления к-ва
        var data = {};
        data.count = $(el).val();
        data.id = $(el).data('id');
        ltcart.cart.sendData(data, $(el).data('url'));

    },

    deleteElement: function (elementId, url) { // обработчик удаления элемента

        ltcart.cart.sendData({elementId: elementId}, url, 'ltcartCartDelete');
        return false;
    },

    sendData: function (data, url, trigger) { // ajax запрос
        var trigger_name = trigger;
        var result = true;
        jQuery.post(url, data,
            function (json) {
                if (json.result == 'fail') {
                    console.log(json.error);
                    result =  false;
                }
                else {
                    ltcart.cart.renderCart(json);
                    if (trigger_name) {
                        $(document).trigger(trigger_name);
                    }

                    //return json;
                    //$(document).trigger('dvizhCartChanged');
                }
            });
        return result;
    },

    renderAll: function (json) {  // рендеринг данных на к-во в кождого товара отдельно,

        for (var key in json.countList) { // к-во корзинок возле товара в каталоге
            var el = $('[data-cart-count-id="' + key + '"]');
            var el_icon = $('[data-cart-count-icon-id="' + key + '"]');
            el.html(json.countList[key]);
            el_icon.html('<span class="icon-bag-red">' + '</span>' + '<span>' + json.countList[key] + '</span>');

        }

        for (var key in json.priceList) { //цена в корзине на каждый товар
            var el = $('[data-cart-price-id="' + key + '"]');
            el.html(json.priceList[key]);
        }

    },

    renderCart: function (json) { // аджакс запрос на получение всех данных
        if (!json) {
            var json = {};
            json.id = 0;
            jQuery.post(ltcart.cart.updateElementUrl, json,
                function (answer) {
                    json = answer;
                    ltcart.cart.renderElements(json);
                }, "json");
        }
        else {
            ltcart.cart.renderElements(json);
        }
        return true;
    },

    renderElements: function (json) { // рендеринг инфы в DOM
        jQuery('.dvizh-cart-block').replaceWith(json.elementsHTML);
        jQuery('.dvizh-cart-count').html(json.count);
        jQuery('.dvizh-cart-price').html(json.price);
        ltcart.cart.renderAll(json);

        jQuery(document).trigger("renderCart", json);
    }
}

$(function () {
    ltcart.cart.init();


    $(document).ready(function () {
        ltcart.cart.renderCart();
    });

    ltcart.cart.alert = function (message, type, title) {
        type = type || "success";
        title = title || false;
        Lobibox.notify(type, {
            size: 'normal',
            rounded: false,
            delayIndicator: false,
            position: 'top right',
            msg: message,
            title: title
        });
    }
});