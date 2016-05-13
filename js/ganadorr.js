$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });

    $('#formularioganador').submit(function() {

        $.ajax({
            type: 'POST',
            url: '../pags/actualizar.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formularioganador')[0].reset();
                $('#result').html(data);
            }
        })
        return false;
    }); 
    
});
var initDatepicker = function() {
    $('input[type=date]')
        .each(function() {
        var $input = $(this);
        $input.datepicker({
            minDate: $input.attr('min'),
            maxDate: $input.attr('max'),
            dateFormat: 'yy-mm-dd'
        });
    });
};
 
if(!Modernizr.inputtypes.date){
    $(document).ready(initDatepicker);
};
