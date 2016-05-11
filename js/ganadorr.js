$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#formularioApuesta').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'actualizar.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formularioApuesta')[0].reset();
                $('#result').html(data);
            }
        })
        return false;
    }); 
    
});