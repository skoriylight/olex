$(function () {

    $(document).on('click',"[data-role='tab-view']", function(){
        $("[data-role='tab-view']").removeClass('active');
        $(this).addClass('active');
        setCookie('tab_view', '', {expires: -1});
        setCookie('tab_view', $(this).data('value'));

        $( "[data-role='tab-view']" ).trigger( "afterSelect" );

    });

    var setCookie = function(name, value, options) {
        options = options || {};
        options.path = '/';
        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }
        document.cookie = updatedCookie;
    }
});