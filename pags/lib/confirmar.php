<?php
require_once('../gestionDB.php');
require_once('../validaciones.php');
              
    $nombreA=limpiarcadenas($_POST['nombre']);
    $cedulaA=limpiarcadenas($_POST['cedula']);
    $valorA=limpiarcadenas($_POST['valor']);
    $fechaPartido = limpiarcadenas($_POST['fecha']);
    $ligaP = limpiarcadenas($_POST['liga']);
    $partido = limpiarcadenas($_POST['partido']);
    $equipoA = limpiarcadenas($_POST['equipoA']);
    $equipoB = limpiarcadenas($_POST['equipoB']);
    $horaP = limpiarcadenas($_POST['hora']);
    $equipoApostado = limpiarcadenas($_POST["equipoapuesta"]);
    

    function ingresarPartido($fechaPartido,$hora,$idequipoA,$idequipoB,$idliga){
    $enlace = connectionDB();
    ingresoPartido($fechaPartido,$hora,$idequipoA,$idequipoB,$idliga,$enlace);
    connectionClose($enlace);
}
//valida existencia o ingresa equipo retorna ID de equipo
function ingresarEquipo($equipo){
    $enlace = connectionDB();
    $id = equipo($equipo, $enlace);
    if($id==null){
        //ingresar equipo a DB
        ingresoEquipos($equipo,$enlace);
        $id= equipo($equipo, $enlace);
    }
    connectionClose($enlace);
    return $id;
}

function buscarLiga($liga){
    $enlace = connectionDB();
    $id = idliga($liga,$enlace);
    if($id==null){
        //ingresar Liga a DB
        ingresoLiga($liga,$enlace);
        $id = idliga($liga,$enlace);
    }
    connectionClose($enlace);
    return $id;
}
function buscarPartido($fechaPartido,$horaP,$idequipoA,$idequipoB,$idliga){
    $enlace = connectionDB();
    $id = idpartido($enlace,$fechaPartido,$horaP,$idequipoA,$idequipoB,$idliga);
    connectionClose($enlace);
    return $id;
    
}

if($partido == '--otro--'){
        //validar equipos
        $idequipoA = ingresarEquipo($equipoA);
        $idequipoB = ingresarEquipo($equipoB);
        $idliga = buscarLiga($ligaP);
       //ingresar datos de partido
        ingresarPartido($fechaPartido,$horaP,$idequipoA,$idequipoB,$idliga);
        $partido = buscarPartido($fechaPartido,$horaP,$idequipoA,$idequipoB,$idliga);
        
    }
        //se recupera datos de partido existente
        // consulta SELECT ID,EQUIPOA,EQUIPOB,LIGA FROM partidos WHERE FECHA='2016-04-29'
        $enlace = connectionDB();
        $partidoData = equiposLigaPartido($enlace,$partido);
        if ($partidoData!=null){
            $A=$partidoData[0];
            $B=$partidoData[1];
            $horapartido=$partidoData[3];
            
            $A = nomEquipo($A,$enlace);
            $B = nomEquipo($B,$enlace);
        }
        connectionClose($enlace);
    $partidotext=$A." VS ".$B." - ".$horapartido;
    
?>
<ul>
    <li>
        <label><strong>Nombre apostador:</strong></label>
        <label><?php echo $nombreA; ?></label>
    </li>
    <li>
        <label><strong>CC apostador: </strong></label>
        <label><?php echo $cedulaA; ?></label>
    </li>
    <li>
        <label><strong>Valor $: </strong></label>
        <label><?php echo $valorA; ?></label>
    </li>
    <li>
        <label><strong>partido: </strong></label>
        <label><?php echo $partidotext; ?></label>
    </li>
    <li>
        <label><strong>Apuesta por: </strong></label>
        <label><?php echo $equipoApostado; ?></label>
    </li>
    <li>
        <button type="submit">confirmar</button><button type="button" id="cancel">Cancelar</button>
    </li>
</ul>
<script type="text/javascript">
    $('#cancel').click(function(){
        $('#confirm').removeClass('visible');
        $('#formulario').removeClass('novisible');
    })
</script>