$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#formularioganador').submit(function() {

        var $partido=$('#partido').val();
        //llenar equiposmpara apostar
        $("#equipo").load("../pags/actualizar.php",{idpartido:$partido});
       // $('#hola').html("<option>"+$(this).val()+"</option><option>");
        return false;
    }); 
    
});