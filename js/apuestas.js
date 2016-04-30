
$(document).ready(function() {
    function cargarpartidosnulos(){
                $.ajax({
            type: 'POST',
            url:'consultas.php',
            data:$('#formularioApuesta').serialize(),
            success: function(data){
                
                $('#partidos').html(data);
            }
        })
                $('#equipoApostado').html("<option value='seleccion'>selecione equipo</option>");
    }
    cargarpartidosnulos();
    
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
            $('#divPartidos').addClass('visible');
            $('#partidoselecionado').val('--otro--');
        }else{
            $('#divPartidos').removeClass('visible');
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
            data:$('#formularioApuesta').serialize(),
            success: function(data){
                
                $('#partidos').html(data);
            }
        })
    })
    $('#partidos').change(function(){
        var idP=$(this).val();
        $("#equipoApostado").load("../pags/lib/llenarcomboapuesta.php",{idpartido:idP});
    })
    $('#otroequipo1').change(function(){
           var rival = $('#otroequipo2').val();                 
        $('#equipoApostado').html("<option value='seleccion'>selecione equipo</option><option>"+$(this).val()+"</option><option>"+rival+"</option>");
                            })
    $('#otroequipo2').change(function(){
             var rival = $('#otroequipo1').val();        
        $('#equipoApostado').html("<option value='seleccion'>selecione equipo</option><option>"+rival+"</option><option>"+$(this).val()+"</option>");
                            })
    $('#enviar').click(function(){
        alert('enviar');
        var nombre=$('#nombre').val();
        var cc=$('#CC').val();
        var valor=$('#valor').val();
        var fecha=$('#fecha').val();
        var liga=$('liga').val();
        var partido="";
        alert(nombre+cc+valor+fecha+liga+partido);
        if($('#partidos').val() == '--otro--'){
            partido=$('#otroequipo1').val()+" VS "+$('#otroequipo2').val()+" - "+$('#hora').val(); 
        }else{
            partido=$('#partidoselecionado').val();
        }
        $('#Nom').html(nombre);
        $('#ced').html(cc);
        $('#val').html(valor);
        $('#fech').html(fecha);
        $('#part').html(partido);
        $('#lig').html(liga);
        
        $("#confirmarenvio").addClass('visible');
        var htmldata="";
        
        //capturar todos los datos pedir confirmacion y dependiendo continuar con el ingreso de apuesta
    })
});