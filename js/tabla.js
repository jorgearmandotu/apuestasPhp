$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });

   
    $('#apuestatotal').submit(function() {
        $.ajax({
            type: 'POST',
            url: '../pags/lib/apuestatotal.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#tablatotal').html(data);
                
            }
        })
        return false;
    }); 
        
    
});