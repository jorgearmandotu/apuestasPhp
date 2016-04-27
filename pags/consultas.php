<?php
require_once('gestionDB.php');
require_once('validaciones.php');//revisar si es necesaria
require_once('lib/carbon.php');

use Carbon\Carbon;

printf('Now: %s', Carbon::now());

//retorna array de todas las ligas registradas
function cmbligas(){
    $enlace = connectionDB();
    $listLigas = ligas($enlace);
    connectionClose($enlace);
    return $listLigas;
}
// retorna todos los partidos para esa fecha

function cmbpartidos($fecha){
    $fecha = '2016/04/29';
    $enlace = connectionDB();
    $listPartidos = partidos($enlace,$fecha);
    connectionClose($enlace);
    //partidos=array();
    $partido="";
    foreach($listPartidos as $p){
       $partido .=$p.' vs ';
    }
    return $partidos;
}

?>