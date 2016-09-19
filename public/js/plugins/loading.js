var loading = loading || (function ($) {
    'use strict';

    var loadingHtml = $(
        '<div id="loading">' +
            '<ul class="bokeh">' +
                '<li></li>' +
                '<li></li>' +
                '<li></li>' +
                '<li></li>' +
                '<li></li>' +
            '</ul>' +
        '</div>'
    );

    return {
        show: function (message, options) {
            if (typeof options === 'undefined') {
                options = {};
            }

            if($('#loading').length === 0) {
                $('body').append(loadingHtml);
            }

            $('#loading').show();
        },
        hide: function () {
            $('#loading').hide();
        }
    };

})(jQuery);
