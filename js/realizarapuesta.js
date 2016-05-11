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
                $("#datosapuesta").html(data);
            }
        })
        return false;
    });
});
