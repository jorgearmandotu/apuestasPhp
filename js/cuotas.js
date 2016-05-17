$(document).ready(function(){
    function cargarptdos(){
        $.ajax({
            type:'POST',
            url:'lib/cmbPartidos.php',
            data:$('#fecha').serialize(),
            beforeSend: function(){
                $('#listpartidos').html('<img src="../images/loading.gif" alt="cargando">');
            },
            success: function(data){
                $('#listpartidos').html(data);
            }
        })
    }
    cargarptdos();
    $('#fecha').change(function(){
        $.ajax({
            type:'POST',
            url:'lib/cmbPartidos.php',
            data: $('#fecha').serialize(),
            beforeSend: function(){
                $('#listpartidos').html('<img src="../images/loading.gif" alt="cargando">');
            },
            success: function(data){
                $('#listpartidos').html(data);
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
