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
    $('#apostar').on('click',function(){
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
       $('.cuotas:checked').each(function() {
        alert("El checkbox con valor " + $(this).val() + " está seleccionado");
           $.post('lib/liveApuesta.php',{datos: $(this).val()},function(data){
               alert(data);
           })
                       });
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


