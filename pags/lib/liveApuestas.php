<?php
require_once'../gestionDB.php';
require_once'../validaciones.php';

$valor = limpiarcadenas($_POST['datos']);
$valorapuesta = limpiarcadenas($_POST['valorapuesta']);
$nomPartido="";
$ids ="";
$nompartido="perez";
$res=$valor."<br>".$valorapuesta.'<br>';
$valcuota=1;
$partidos= explode('*',$valor);
for($i = 0;$i<count($partidos)-1;$i++){
    $datos= explode('%',$partidos[$i]);
    $ids[$i] =$datos[1];
    $cuota[$i]=$datos[0];
    $apuesta[$i]=$datos[2];
}
for($l=0;$l<count($ids);$l++){
    $enlace=connectionDB();
    if(isset($ids[$l])){
    $nompartido= nompartido($enlace,$ids[$l]);//cargar datos de partido con el cual generar nombre y y jorario par avaliar los dato
    $horapartido = fechahorapartido($enlace,$ids[$l]);
    connectionClose($enlace);
        date_default_timezone_set("America/Bogota");
        $dActual= new datetime();
        $d = new datetime($horapartido);
        $d->modify('-1 minutes');
    if($dActual<$d){//verificar esta hora
        $nompartido='<label>partido iniciado</label>';
    }
    $valcuota = $valcuota*floatval($cuota[$l]);
    $res.='<label>'.$nompartido.'</label><br />'.'cuota: '.$cuota[$l].' apuesta: '.$apuesta[$l].'<br><button value="'.$partidos[$l].'" id="eli"></button><hr>';}
}
$valcuota=round($valcuota,2);
$total=$valorapuesta*$valcuota;
$total=number_format($total, 2, ",", ".");
$res.='<input type="hidden" id=valcuot value="'.$valcuota.'"><label>cuota total: '.$valcuota.'</label><br><label>Ganancias: </label><label id=gantotal>'.$total.'</label><br><button type="button" id="apostar">apostar</button>';
echo $res;
//echo '<button type="button" id="apostar>apostar</button>';
?>