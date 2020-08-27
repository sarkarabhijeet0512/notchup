(function ($) {
    "use strict";
    var $wn =  $(window);
    $wn.on('load',function () {

            

            /*****************
             *   Datepicker  *
             *****************/
            var $element = $('.datepicker');
            if ($element.length > 0) {
                $element.datepicker()
            }
        });

    

})(jQuery);
