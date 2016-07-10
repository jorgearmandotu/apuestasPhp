$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#formularioAsesor').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'ingresosUpdates.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formularioAsesor')[0].reset();
                $('#result').html(data);
            }
        })
        return false;
    }); 
    
    $('#formularioPartido').submit(function() {
        $.ajax({
            type: 'POST',
            url: '../pags/lib/ingresarPartido.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formularioPartido')[0].reset();
                $('#result').html(data);
            }
        })
        return false;
    }); 
    $('#liga').on('change',function(){
       $.ajax({
           type: 'POST',
           url: '../pags/lib/listequipos.php',
           data: $(this).serialize(),
           success: function(data){
               $('#equipoa').html(data);
               $('#equipob').html(data);
           }
       }) 
    });
    
    $('#pais').on('change',function(){
        $('#equipoa').val('val0');
        $('#equipob').val('val0');
        $.ajax({
            type: 'POST',
            url: '../pags/lib/listequipos.php',
            data: $(this).serialize(),
            success: function(data){
                $('#liga').html(data);
            }
        })
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
var initTimepicker = function() {
    $('input[type=time')
        .each(function() {
        var $input = $(this);
        $input.timepicker($.timepicker.regional['es']
        );
    });
};
if(!Modernizr.inputtypes.time){
    $(document).ready(initTimepicker);
};