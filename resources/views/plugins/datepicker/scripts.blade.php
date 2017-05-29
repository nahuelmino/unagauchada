<script src="/plugins/jquery-ui-datepicker/jquery-ui.js"></script>
<script>

    $(function() {

        var pagesWithMinDate = ['/gauchadas/create'];
        var pagesWithChangeYear = ['/register'];
        var date = new Date(new Date().getTime() + 86400000);

        var datepickerOptions = {
            dateFormat: 'dd/mm/yy',
            monthNames: [ "Enero","Febrero","Marzo","Abril","Mayo","Junio",
                "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ],
            monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
            dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
            dayNamesShort: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
            dayNamesMin: [ "Do","Lu","Ma","Mi","Ju","Vi","Sa" ],
            changeMonth: true,
            changeYear: true
        };

        // Determinar si la página actual es la de crear gauchadas para aplicar minDate

        var url = window.location.pathname;

        for(var i = 0; i < pagesWithMinDate.length; i++) {
            if (url === pagesWithMinDate[i]) {
                var today = new Date();
                datepickerOptions.minDate = new Date(today.getTime() + 86400000);
            }
        }

        for(var i = 0; i < pagesWithChangeYear.length; i++) {
            if (url === pagesWithChangeYear[i]) {
                datepickerOptions.changeYear = true;
                datepickerOptions.changeMonth = true;
                datepickerOptions.maxDate = new Date();
                datepickerOptions.yearRange = "-80:+80"
            }
        }

        var datepicker = $('.datepicker').datepicker(datepickerOptions);

    });

</script>