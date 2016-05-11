$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
   
        
    $('#fecha').change(function(){
                $.ajax({
            type: 'POST',
            url:'llenarganador.php',
            data:$('#formularioganador').serialize(),
            success: function(data){
                
                $('#partido').html(data);
            }
        })
                //$('#partido').html("<option value='seleccion'>selecione equipo</option>");
    })
    
    $('#partido').change(function(){
        var idP=$(this).val();
        //llenar equiposmpara apostar
        $("#equipo").load("../pags/lib/llenarcomboapuesta.php",{idpartido:idP});
       // $('#hola').html("<option>"+$(this).val()+"</option><option>");
    })
    
    
    
});
function confirmar(){
  //var nombre=$('#nombre').val();
   // var cc=$('#CC').val();
    var equipo = $('#equipo').val();
    //var valor=parseFloat($('#valor').val());
    var partido=$('#partido').val();
    //var saldo = $('#saldo').val();
    if(partido=='seleccion'){
        alert("seleccione partido");
        return false;
    }else{ if(equipo=='seleccion'){
        alert('Seleccione equipo a apostar');
        return false;
    }
         }
    
}
