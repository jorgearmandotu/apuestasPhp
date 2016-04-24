$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#formularioAsesor').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'ingresosUpdates.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formularioAsesor')[0].reset();
                $('#result').html(data);
            }
        })
        return false;
    }); 
    
})