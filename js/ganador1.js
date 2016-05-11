$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    
    
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
        //$('#saldo').val(sal);
    }
    
    cargarpartidosnulos();
    
    
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
        //llenar equiposmpara apostar
        $("#equipoApostado").load("../pags/lib/llenarcomboapuesta.php",{idpartido:idP});
        $('#hola').html("<option>"+$(this).val()+"</option><option>");
    })
    
    /*$('#partidos').change(function(){
        var idP=$(this).val();
        $("#equipoApostado").load("../pags/lib/llenarcomboapuesta.php",{idpartido:idP});
        
        
    })*/
    
});
function confirmar(){
    var nombre=$('#nombre').val();
    var cc=$('#CC').val();
    var equipo = $('#equipoApostado').val();
    var valor=parseFloat($('#valor').val());
    var partido=$('#partidos').val();
    var saldo = $('#saldo').val();
    if(partido=='seleccion'){
        alert("seleccione partido");
        return false;
    }else if(partido=='--otro--'){
        var A=$('otroequipo1').val();
        var B=$('otroequipo2').val();
        var H=$('#hora').val();
        if(A==""||B==""||H==""){
            alert("verifique que todos los campos esten llenos")
            return false;
        }
    }else if(valor<5000 || valor>300000){
        alert('Las apuestas deben ser de un minimo de $5000 y maximo de $300000');
        return false;
    }
    
    if(equipo=='seleccion'){
        alert('Seleccione equipo ganador');
        return false;
    }if(saldo<valor){
        alert('Usted no dispone de saldo suficiente para esta apuesta');
        return false;
    }
    if (confirm("desea realizar la actualizacion equipo ganador"+equipo)){
        return true;
    }return false;
} 