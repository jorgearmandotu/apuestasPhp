$(document).ready(function(){
    function paises(){
        var listPa = 'listadoPaises';
        var datos= {'listpaises' : listPa};
        $.ajax({
            type: 'POST',
            url : 'lib/gestionligas.php',
            data: datos,
            success: function(data){
                $('#pais').html(data);
            }
        })
    }
    paises();
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
                paises();
            }
        })
        evento.preventDefault();
    });
});