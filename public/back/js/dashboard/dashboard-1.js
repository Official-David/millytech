(function($) {
    /* "use strict" */

    var dzChartlist = function() {

        var screenWidth = $(window).width();
        var donutChart1 = function() {
            $("span.donut1").peity("donut", {
                width: "5.75rem",
                height: "5.75rem"
            });
            $(window).resize(function() {
                $("span.donut1").peity("donut", {
                    width: "5.75rem",
                    height: "5.75rem"
                });
            })
        }



        /* Function ============ */
        return {
            init: function() {},


            load: function() {
                donutChart1();
            },

            resize: function() {}
        }

    }();



    jQuery(window).on('load', function() {
        setTimeout(function() {
            dzChartlist.load();
        }, 2000);

    });



})(jQuery);