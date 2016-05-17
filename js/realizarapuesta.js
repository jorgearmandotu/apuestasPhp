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
        });
        
    });
    $('#realizarapuestas').on('click','#apostar',function(){
        var valor = $('#valor').val();
        var saldo = $('#saldo').val();
        saldo= parseFloat(saldo);
        valor = parseFloat(valor);
        if(valor>300000 || valor<5000){
            alert('La apuesta minima es de $5000 y la maxima de $300000')
        }else if(saldo < valor){
            alert('Usted no posee saldo suficiente para realisar esta apuesta'+saldo+valor)
        }
        else{
            $('#miniformulario').submit();
        }
    });
    
    $('#listpartidos').on('click','.cuotas',function(){
        var info="";
        var apuestaval=$('#valor').val();
       $('.cuotas:checked').each(function() {
          info = info+$(this).val()+"-";
                       });
         var datos= {'datos' : info,
                    'valorapuesta' : apuestaval};
        $.ajax({
               data : datos,
               url: '../pags/lib/liveApuestas.php',
               type: 'post',
               beforeSend: function(){
                   $('#realizarapuestas').html('Cargando...')
               },
               success: function(response){
                   $('#realizarapuestas').html(response);
               }
           })
    
    })
    
    var initDatepicker = function() {
    $('input[type=date]')
        .each(function() {
        var $input = $(this);
        $input.datepicker({
            minDate: $input.attr('min'),
            maxDate: $input.attr('max'),
            dateFormat: 'yy-mm-dd'
        });
    });
};
 
if(!Modernizr.inputtypes.date){
    $(document).ready(initDatepicker);
};
});


