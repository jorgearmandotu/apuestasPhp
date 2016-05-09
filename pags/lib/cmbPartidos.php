<?php
require_once '../gestionDB.php';

$fecha = strip_tags($_POST['fecha']);
$enlace = connectionDB();
$partidos = partidos($enlace,$fecha);
 $res="<h2>Listado de partidos</h2>
 <table><tr><th><label>partido - hora</label></th>
 <th><label> 1 </label></th>
 <th><label> X </label></th>
 <th><label> 2 </label></th>";
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
        
        $res.="<li><form method='POST' id='miniformulario' action='lib/cuotas.php'>
        
        <input type='text' name='id' value='".$idP."' class='ids'>
        <tr><td class='tdpartido'>
        <label>".$nomEquiA."_ vs _ ".$nomEquiB." - ".$hora." </label></td>

        <td><input type='number' step='any' class='cuotas' value='".$local."' name='cuota1' min='0'></td>

        <td><input type='number' step='any' class='cuotas' value='".$empate."' name='cuotax' min='0'></td>

        <td><input type='number' step='any' class='cuotas' value='".$visitante."'  name='cuota2' min='0'></td>
        <td><button type='input'>ACTUALIZAR</button></td></tr>
        </form></li>";
}
connectionClose($enlace);
$res.="</table>";
echo $res;

?>
        
        
        