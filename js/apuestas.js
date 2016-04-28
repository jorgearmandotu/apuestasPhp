
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    //detecta el cambio ed comobox partidos y asigna valor a input o habilita el ingreso de nuevo partido
    $('select#partidos').on('change',function(){
        var val = $(this).val();
        if(val == '--otro--'){
            $('#divPartidos').addClass('visiblePartido');
            $('#partidoselecionado').val('--otro--');
        }else{
            $('#divPartidos').removeClass('visiblePartido');
            //alert($('select[id=partidos]').val());
            $('#partidoselecionado').val($(this).val());
        }
    })
    //detecta el valor del equipo por el que se apuesta y asigna al input
    $('#equipoApostado').change(function(){
        //alert($('select[id=equipoApostado]').val());
        $('#equipoapuesta').val($(this).val());
    })
    
    $('#fecha').change(function(){
        $.ajax({
            type: 'POST',
            url:'consultas.php',
            data:"idfecha="+$("#fecha").val(),
            success: function(opciones){
                $('#partidos').html(opciones)
            }
        })
    })
})