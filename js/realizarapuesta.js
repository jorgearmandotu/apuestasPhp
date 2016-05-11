$(document).ready(function(){
    function cargarptdos(){
        $.ajax({
            type:'POST',
            url:'lib/partidosapuesta.php',
            data:$('#fecha').serialize(),
            success: function(data){
                $('#listpartidos').html(data);
            }
        })
    }
    cargarptdos();
    $('#fecha').change(function(){
        $.ajax({
            type:'POST',
            url:'lib/partidosapuesta.php',
            data: $('#fecha').serialize(),
            success: function(data){
                $('#listpartidos').html(data);
            }
        })
    });
    $('#miniformulario').submit(function(){
        $.ajax({
            type: 'POST',
            url: 'lib/gestionApuesta.php',
            data: $(this).serialize(),
            success: function(data){
                $("#datosapuestas").html(data);
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