<script src="/plugins/jquery-ui-datepicker/jquery-ui.js"></script>
<script>

    function setDatepicker() {
        var pagesWithMinDate = ['/gauchadas/create'];
        var pagesWithChangeYear = ['/register'];
        var pagesWithNoDays = ['/comprar'];
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
            changeYear: true,
        };

        // Determinar si la página actual es la de crear gauchadas para aplicar minDate

        var url = window.location.pathname;
        var i = 0;

        for(i = 0; i < pagesWithMinDate.length; i++) {
            if (url === pagesWithMinDate[i]) {
                var today = new Date();
                datepickerOptions.minDate = new Date(today.getTime() + 86400000);
            }
        }

        for(i = 0; i < pagesWithChangeYear.length; i++) {
            if (url === pagesWithChangeYear[i]) {
                datepickerOptions.maxDate = new Date();
                datepickerOptions.yearRange = "-80:+80"
            }
        }

        for(i = 0;i < pagesWithNoDays.length; i++) {
            if (url === pagesWithNoDays[i]) {
                // setear datepicker para que no muestre dias (solo meses y años)
                datepickerOptions.dateFormat = 'mm/yy';
                datepickerOptions.showButtonPanel = true;
                datepickerOptions.onClose = function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));
                };
            }
        }

        var datepicker = $('.datepicker').datepicker(datepickerOptions);

        if (datepickerOptions.dateFormat === 'mm/yy') {
            $(".datepicker").focus(function () {
                $(".ui-datepicker-calendar").hide();
                var calendarHeight = $('.ui-datepicker-calendar').height();
                var thisDatepicker = $(this);
                console.log();
                setTimeout(function () {
                    $('#ui-datepicker-div').css({
                        top: $(thisDatepicker).position().top + calendarHeight - 60 + 'px',
                    })
                }, 0);

            });
        }
    }

    $(function() {

        setDatepicker();
        
    });

</script>