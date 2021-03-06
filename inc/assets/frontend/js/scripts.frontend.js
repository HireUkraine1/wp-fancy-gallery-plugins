"use strict";

(function ($) {

    $(document).on("ready", function () {

        var wall = new Freewall("#freewall");
        wall.reset({
            selector: '.item',
            animate: true,
            cellW: 110,
            cellH: 110,
            onResize: function() {
                wall.fitWidth();
            }
        });
        wall.fitWidth();

        $(window).trigger("resize");

        $('.gallary-item').fancybox({
            titlePosition: "inside",
            cyclic: true,
            'titleFormat': formatTitle
        });

        function formatTitle(title, currentArray, currentIndex, currentOpts) {
            var descr = $(currentArray[currentIndex]).find('img').attr('alt');

            return '<div id="tip7-title"><p>'+title+'</p><p>'+descr+'</p></div>';
        }

    })

})(jQuery);