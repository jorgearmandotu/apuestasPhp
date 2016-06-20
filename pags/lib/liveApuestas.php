<?php
require_once'../gestionDB.php';
require_once'../validaciones.php';

$valor = limpiarcadenas($_POST['datos']);
$valorapuesta = limpiarcadenas($_POST['valorapuesta']);
$nomPartido="";
$ids ="";
$res="";
$valcuota=1;
$partidos= explode('-',$valor);
for($i = 0;$i<count($partidos)-1;$i++){
    $datos= explode(':',$partidos[$i]);
    $ids[$i] =$datos[1];
    $cuota[$i]=$datos[0];
    $apuesta[$i]=$datos[2];
}
for($l=0;$l<count($ids);$l++){
    $enlace=connectionDB();
    if(isset($ids[$l])){
    $nompartido= nompartido($enlace,$ids[$l]);
    $horapartido = fechahorapartido($enlace,$ids[$l]);
    connectionClose($enlace);
        date_default_timezone_set("America/Bogota");
        $dActual= new datetime();
        $d = new datetime($horapartido);
        $d->modify('-1 minutes');
    if($dActual>$d){
        $nompartido='<label>partido iniciado</label>';
    }
    $valcuota = $valcuota*floatval($cuota[$l]);
    $res.='<label>'.$nompartido.'</label><br />'.'cuota: '.$cuota[$l].' apuesta: '.$apuesta[$l].'<br><hr>';}
}
$total=$valorapuesta*$valcuota;
$total=number_format($total, 2, ",", ".");
$res.='<label>Ganancias: </label>'.$total.'<br><button type="button" id="apostar">apostar</button>';
echo $res;
//echo '<button type="button" id="apostar>apostar</button>';
?>