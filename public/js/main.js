(function($) {

    $(document).ready(function() {

        $('.numbers-only').on('keydown', function(e){

            -1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()

        });

        $('.needs-confirmation').on('click', function(e) {
            var message = $(this).data('confirmation-message') || '¿Esta seguro de que desea realizar esta acción?';
            if (!confirm(message)) {
                return false;
            }
        }); 


    });


})(jQuery);