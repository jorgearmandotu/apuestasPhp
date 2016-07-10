<?php
require_once '../validaciones.php';
require_once '../gestionDB.php';

if(isset($_POST['liga'])){
    $liga = limpiarcadenas($_POST['liga']);
    $enlace = connectionDB();
    $equipos = equipos($enlace,$liga);
    echo '<option>seleccione equipo</option>';
    for($i=0;$i<count($equipos);$i++){
        echo '<option value="'.$equipos[$i][1].'">'.$equipos[$i][0].'</option>';
    }
}
if(isset($_POST['pais'])){
    $pais = limpiarcadenas($_POST['pais']);
    $enlace = connectionDB();
    $ligas = ligas($enlace,$pais);
    echo '<option>seleccione liga</option>';
    for($i=0;$i<count($ligas);$i++){
        echo '<option value='.$ligas[$i][1].'>'.$ligas[$i][0].'</option>';
    }
}
?>