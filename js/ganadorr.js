$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });

    $('#formularioganador').submit(function() {

        $.ajax({
            type: 'POST',
            url: '../pags/actualizar.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formularioganador')[0].reset();
                $('#result').html(data);
            }
        })
        return false;
    }); 
    
});