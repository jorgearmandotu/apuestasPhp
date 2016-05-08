$(document).ready(function(){
    function cargarptdos(){
        $.ajax({
            type:'POST',
            url:'lib/cmbPartidos.php',
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
            url:'lib/cmbPartidos.php',
            data: $('#fecha').serialize(),
            success: function(data){
                $('#listpartidos').html(data);
            }
        })
    });
    
})