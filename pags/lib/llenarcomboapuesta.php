<?php
require_once('../gestionDB.php');

$idp = $_REQUEST['idpartido'];

$arr = array();

$enlace = connectionDB();
$arr=equiposLigaPartido($enlace,$idp);
if($arr){
    $idEquipoA=$arr[0];
    $idEquipoB=$arr[1];
    $noma = nomEquipo($idEquipoA,$enlace);
    $nomb = nomEquipo($idEquipoB,$enlace);
}
connectionClose($enlace);
echo("<option value='seleccion'>selecione equipo</option><option value='".$idEquipoA."'>".$noma."</option>
<option value='".$idEquipoB."'>".$nomb."</option><option value='Empate'>Empate</option>");

?>