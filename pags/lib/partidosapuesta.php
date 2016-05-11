<?php
require_once '../gestionDB.php';

$fecha = strip_tags($_POST['fecha']);
$enlace = connectionDB();
$partidos = partidos($enlace,$fecha);
 $res="<div class='fila'>
                <div class='celda1' id='encabezado'>
                    <label>partido - hora </label></div>
                <div class='celda2'>
                    <label> 1 </label></div>
                <div class='celda3'>
                    <label> X </label></div>
                <div class='celda4'>
                    <label> 2 </label></div>
              </div>
              <div class='celda5'></div>
              <form method='POST' id='miniformulario' action=''>";


for($i=0;$i<count($partidos);$i++){
    $idP=$partidos[$i][0];
    $nomEquiA=$partidos[$i][1];
    $nomEquiB=$partidos[$i][2];
    $nomLiga=$partidos[$i][3];
    $hora=$partidos[$i][4];
    $local=$partidos[$i][5];
    $empate=$partidos[$i][6];
    $visitante=$partidos[$i][7];
    $nomLiga = nomLiga($nomLiga,$enlace);
        
//    la siguiente cadena crea los botones y el formulario q se reenvia a la misma paguina en viando los datos cuando se ha seleccionado halgo el botn apostar y los inputs con la id del partido y el valor de la cuota seleccionada no deben ser visibles se hace con css
        $res.="<div class='fila'>
            
        <div class='celda1'>
         <label>".$nomEquiA."_vs_".$nomEquiB." - ".$hora." </label>
        </div>
        <div class='celda2'>
            <input type='checkbox' class='cuotas' value='".$local.":".$idP.":L' name='cuota[]' id='btn'>".$local."</input>
       
       </div>
       <div class='celda3'>
            <input type='checkbox' class='cuotas' value='".$empate.":".$idP.":E' name='cuota[]'>".$empate."</input>
        </div>
        
        <div class='celda4'>
        <input type='checkbox' class='cuotas' value='".$visitante.":".$idP.":V'  name='cuota[]'>".$visitante."</input>
        
        </div>
        
        
              </div>";
}
connectionClose($enlace);
$res.="<button type='submit' id='apostar'>apostar</button>
        </form>";
echo $res;

?>