$(document).ready(function(){
    var respuestas="";
    var arrcuotas = new Array();
    var cuota=1;
    var datosap;
    function cargarptdos(){
        $.ajax({
            type:'POST',
            url:'lib/partidosapuesta.php',
            data:$('#fecha').serialize(),
            beforeSend: function(){
                $('#listpartidos').html('<img src="../images/loading.gif" alt="cargando">');
            },
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
            beforeSend: function(){
                $('#listpartidos').html('<img src="../images/loading.gif" alt="cargando">');
            },
            success: function(data){
                $('#listpartidos').html(data);
            }
        });
        
    });
    $('#liga').change(function(){
        $.ajax({
            type:'post',
            url:'lib/partidosapuesta.php',
            data:{
                'fecha': $('#fecha').val(),
                'liga': $('#liga').val()
            },
            beforeSend: function(){
                $('#listpartidos').html('<img src="../images/loading.gif" alt="cargando">');
            },
            success: function(data){
                $('#listpartidos').html(data);
            }
        });
    });
    $('#realizarapuestas').on('click','#apostar',function(){
        var valor = $('#valor').val();
        var saldo = $('#saldo').val();
        if(valor==''){valor=0;}
        saldo= parseFloat(saldo);
        valor = parseFloat(valor);
        if(valor>300000 || valor<5000){
            alert('La apuesta minima es de $5000 y la maxima de $300000')
        }else if(saldo < valor){
            alert('Usted no posee saldo suficiente para realisar esta apuesta')
        }
        else{
            $('#strapuesta').val(datosap);
            $('#vlrapuesta').val(valor);
            $('#strform').submit();
        }
    });
    
    $('#listpartidos').on('click','.cuotas',function(){
        var info="";
        var apuestaval=$('#valor').val();
        if( $(this).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
            info = $(this).val()+'-';
            arrcuotas.push(info);
            cuota=1;
            for(i in arrcuotas){
                var temp= arrcuotas[i];
                var cuotas=temp.split(':');
                cuota = parseFloat(cuotas[0])*cuota;
            }
            //cuota= cuota*$('#valor').val();
            
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        for(i in arrcuotas){
            var a = arrcuotas[i];
            var e = $(this).val();
            if(a==(e+'-')){
                arrcuotas.splice(i,1);
                break;
            }
        }
    }
        datosap=datosApuestas(arrcuotas);
        respuestas="";
//       $('.cuotas:checked').each(function() {
//          info = info+$(this).val()+"-";
//                       });
         var datos= {'datos' : datosap,
                    'valorapuesta' : apuestaval};
        $.ajax({
               data : datos,
               url: '../pags/lib/liveApuestas.php',
               type: 'post',
               beforeSend: function(){
                   $('#realizarapuestas').html('Cargando...')
               },
               success: function(response){
                   respuestas=respuestas+response;
                   
                   $('#realizarapuestas').html(respuestas);
               }
           })
    
    })
    
    $('#realizarapuestas').on('click','#eli',function(){
        for(i in arrcuotas){
            var a = arrcuotas[i];
            var e = $(this).val();
            if(a==(e+'-')){
                arrcuotas.splice(i,1);
                var idp=e.split(':');
                if(idp[2]=='1'){
                    idp=idp[1];
                }else if(idp[2]=='X'){
                    idp=idp[1]+'a';
                }else{
                    idp=idp[1]+'b';
                }
                
                idp='#'+idp;
                $(idp).prop('checked',false);
                break;
            }
        }
        datosap=datosApuestas(arrcuotas);
        respuestas="";
//       $('.cuotas:checked').each(function() {
//          info = info+$(this).val()+"-";
//                       });
         var datos= {'datos' : datosap,
                    'valorapuesta' : $('#valor').val()};
        $.ajax({
               data : datos,
               url: '../pags/lib/liveApuestas.php',
               type: 'post',
               beforeSend: function(){
                   $('#realizarapuestas').html('Cargando...')
               },
               success: function(response){
                   respuestas=respuestas+response;
                   
                   $('#realizarapuestas').html(respuestas);
               }
           })
    })
    
    $('#valor').on('keyup',function(){
        var v=$(this).val();
        var c=$('#valcuot').val();//undefinid cuando aun no se ha a postado
        if(c!=undefined){
            var r=v*c;
            r=parseFloat(r);
            r=formatNumber.new(r); // retorna "123.456.779,18"
            document.getElementById('gantotal').innerHTML =r;
        }
    })
    
    var formatNumber = {
    separador: ".", // separador para los miles
    sepDecimal: ',', // separador para los decimales
    formatear:function (num){
    num +='';
    var splitStr = num.split('.');
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
    splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
    }
    return this.simbol + splitLeft +splitRight;
    },
    new:function(num, simbol){
    this.simbol = simbol ||'';
    return this.formatear(num);
        }
    }
    
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
}
    
    
    
 });    

function datosApuestas(arrcuotas){
    var dinfo="";
    for(i in arrcuotas){
                dinfo=dinfo+arrcuotas[i];
            }
    return dinfo;
}
