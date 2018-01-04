if (typeof ltfavorite == "undefined" || !ltfavorite) {
    var ltfavorite = {};
}


ltfavorite.favorite = {


    putBtn: '[data-role="favorite-put-btn"]',
    delBtn: '[data-role="favorite-delete-btn"]',
    countBtn: '[data-role="favorite-count-btn"]',


    init: function () {

        jQuery(document).on('click', ltfavorite.favorite.putBtn, function (event) {

            var self = this;
            url = $(this).data('url');
            var data = {
                id: $(self).data('id'),
                model_class: $(self).data('model'),
            };
            ltfavorite.favorite.sendData(data, url, 'after_put', self);
            event.preventDefault();
            return false;
        });

        jQuery(document).on('after_put', ltfavorite.favorite.putBtn, function (event, json){
            if(json.action == 'put'){
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
            ltfavorite.favorite.renderData(json);

        });

        jQuery(document).on('after_delete', ltfavorite.favorite.delBtn, function (event, json){

            ltfavorite.favorite.renderData(json);

        });

        jQuery(document).on('click',ltfavorite.favorite.delBtn, function (event) {

            var self = this;
            url = $(this).data('url');
            var data = {
                id: $(self).data('id'),
                model_class: $(self).data('model'),
            };

            ltfavorite.favorite.sendData(data, url, 'after_delete', self);
            event.preventDefault();
            return false;
        });


    },

    alert: function (message) { // алерт вполняющийся после зпроса
        alert(message);
    },

    renderData: function(json) {
        $(ltfavorite.favorite.countBtn).text(0);

        for (key in json.count) {

            var rep = "[data-model=\""+key.replace(/\\/g,"\\\\")+"\"]";
            $(ltfavorite.favorite.countBtn+rep).text(json.count[key]);
        }
    },


    sendData: function (data, url, trigger, element) { // ajax запрос
        var trigger_name = trigger;
        var element = element;

        jQuery.post(url, data,
            function (json) {
                if (json.result == 'fail') {
                    console.log(json.error);
                }
                else {
                    if (trigger_name) {
                        $(element).trigger(trigger_name, json);
                    }

                }
            });
        return false;
    },
}

$(function () {
    ltfavorite.favorite.init();


   /* ltcart.cart.alert = function (message) {

        Lobibox.notify("success", {
            size: 'mini',
            rounded: true,
            delayIndicator: false,
            msg: message
        });
    }*/
});