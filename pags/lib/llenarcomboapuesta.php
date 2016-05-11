<?php
require_once('../gestionDB.php');

$idp = $_REQUEST['idpartido'];

$arr = array();

$enlace = connectionDB();
$arr=equiposLigaPartido($enlace,$idp);
if($arr){
    $idEquipoA=$arr[0];
    $idEquipoB=$arr[1];
    
}
connectionClose($enlace);
echo("<option value='seleccion'>selecione equipo</option><option value='".$idEquipoA."'>".$idEquipoA."</option>
<option value='".$idEquipoB."'>".$idEquipoB."</option><option value='Empate'>Empate</option>");

?>