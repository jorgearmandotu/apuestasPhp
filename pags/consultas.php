<?php
require_once('gestionDB.php');
require_once('validaciones.php');//revisar si es necesaria
require_once('lib/carbon.php');

use Carbon\Carbon;

//printf('Now: %s', Carbon::now());

//retorna array de todas las ligas registradas
function cmbligas(){
    $enlace = connectionDB();
    $listLigas = ligas($enlace);
    connectionClose($enlace);
    return $listLigas;
}
// retorna todos los partidos para esa fecha

function cmbpartidos(){
//    $fecha=strip_tags($_POST['fecha']);
//    $liga=strip_tags($_POST['liga']);
    $enlace = connectionDB();
    echo("<script>alert('%%%%%');</script>");
//    $listPartidos = partidos($enlace,$fecha);
    connectionClose($enlace);
    //partidos=array();
    $partido="";
//    foreach($listPartidos as $p){
//       $partido .=$p.' vs ';
//    }
    $partidos="<option value='seleccion'>Seleciona partido</option>
                             <option value='partido1'>partidote 1</option>
                             <option value='partido2'>partidote 2</option>
                             <option value='--otro--'>--otrosssss--</option>";
    return $partidos;
}
cmbpartidos();

?>