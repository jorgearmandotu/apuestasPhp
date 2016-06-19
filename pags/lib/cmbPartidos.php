<?php
require_once '../gestionDB.php';
require_once '../validaciones.php';

$fecha = limpiarcadenas($_POST['fecha']);
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
              <div class='celda5'></div>";
//$res.= "<option value='--seleccion--'>--seleccione partido--</option>";
//0,0 id, 0,1 local, 0,2 visitante, 0,3 liga, 0,4 hora
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
        
        $res.="<div class='fila'>
           
            <form method='POST' id='miniformulario' action='lib/cuotas.php'>
        <div class='celda1'>
        <input type='text' name='id' value='".$idP."' class='ids'>
        
            <label>".$nomEquiA."_vs_".$nomEquiB." - ".$hora." </label>
        </div>
        <div class='celda2'>
            <input type='number' step='any' class='cuotas' value='".$local."' name='cuota1' min='0'>
        </div>
       <div class='celda3'>
            <input type='number' step='any' class='cuotas' value='".$empate."' name='cuotax' min='0'>
        </div>
        <div class='celda4'>
        <input type='number' step='any' class='cuotas' value='".$visitante."'  name='cuota2' min='0'>
        </div>
        <div class='celda5'>
            <button type='submit' class='btn'>ACTUALIZAR</button>
        </div>
        </form>
        
              </div>";
}
connectionClose($enlace);
echo $res;

?>
        
        
        