if (typeof ltcart == "undefined" || !ltcart) {
    var ltcart = {};
}

ltcart.btnCount = {
    init: function(){
        $(document).on('change', '[data-role="cart-update-count-btn"]', function(){
            var self = this;

            var selector = $(self).data('target');
            $(selector).val($(self).val());
        })
    }
}

$(function () {
    ltcart.btnCount.init();



});