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
    //cargarptdos();
    $('#fecha').change(function(){
        $.ajax({
            type:'POST',
            url:'lib/partidosapuesta.php',
            data: $('#fecha').serialize(),
            success: function(data){
                $('#listpartidos').html(data);
            }
        });
        
    });
    $('#apostar').click(function(){
        var valor = $('#valor').val();
        var saldo = $('#saldo').val();
        if(valor>300000 || valor<5000){
            alert('La apuesta minima es de $5000 y la maxima de $300000')
        }else if(saldo<valor){
            alert('Usted no posee saldo suficiente para realisar esta apuesta')
        }
        else{
            $('#miniformulario').submit();
        }
    });
//    $('#miniformulario').submit(function(){
//        $.ajax({
//            type: 'POST',
//            url: 'lib/gestionApuesta.php',
//            data: $(this).serialize(),
//            success: function(data){
//                $("#datosapuestas").html(data);
//            }
//        })
//        return false;
//    });
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
});


