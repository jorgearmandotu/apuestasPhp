$(document).ready(function(){
    $('#pais').on('change',function(){
        $.ajax({
            type: 'POST',
            url: 'lib/listequipos.php',
            data: $(this).serialize(),
            success: function(data){
                $('#listligas').html(data);
            }
        })
    });
    
    $('#insertequipo').on('click',function(evento){
        $.ajax({
            type: 'POST',
            url: 'lib/gestionligas.php',
            data: $('#equipoform').serialize(),
            success: function(data){
                $('#respuesta').html(data);
                document.getElementById("equipoform").reset();
            }
        })
        evento.preventDefault();
    });
    
    $('#insertliga').on('click',function(evento){
        $.ajax({
            type: 'POST',
            url: 'lib/gestionligas.php',
            data: $('#ligaform').serialize(),
            success: function(data){
                $('#respuesta').html(data);
                document.getElementById("ligaform").reset();
            }
        })
        evento.preventDefault();
    });
});