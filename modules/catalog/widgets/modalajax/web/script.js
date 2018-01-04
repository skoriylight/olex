if (typeof modalajax == "undefined" || !ltcart) {
    var modalajax = {};
}

modalajax = {
    init: function () {
        var self;

        $(document).on('click', '[data-role="modalajax"]', function (event) {
            var data = modalajax.renderData(this);
            modalajax.renderModal(data);
            event.preventDefault();
        });

        $(document).on('hidden.bs.modal', '[data-role="modalajax-alert"]', function (e) {
            modalajax.clearModal();

        });

        $(document).on('show.bs.modal', '[data-role="modalajax-alert"]', function (e) {

        });

    },

    renderModal: function (data) {
        var res = '<div class="modal fade"  tabindex="-1" aria-hidden="false" id="modelajax" aria-labelledby="myModalLabel" role="dialog" data-role="modalajax-alert">';
        res+= '<div class="modal-dialog modal-ajax-lg">';
        res+= '<div class="modal-content">';
        res+= '<div class="modal-header">';
        res+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        res+= '<h4 class="modal-title"></h4>';
        res+= '</div>';
        res+= '<div class="modal-body" style="min-height: 300px">';
        res+= data;
        res+= '</div>';
        res+= '</div>';
        res+= '</div>';
        res+= '</div>';
        $('body').append(res);

        $('#modelajax').modal();
        $('#modelajax').modal('show');
        $(document).trigger('modalajax.afterRender');

    },

    renderData: function (el){

        jQuery.post($(el).data('url'), {},
            function (data) {
                $('[data-role="modalajax-alert"] .modal-body').html(data);
            });

    },


    clearModal: function(){
        $('[data-role="modalajax-alert"]').remove();
    }
};

$(function () {
    modalajax.init();


});