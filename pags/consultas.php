<?php
require_once('gestionDB.php');
require_once('validaciones.php');//revisar si es necesaria
//require_once('lib/carbon.php');

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
    $fecha=strip_tags($_POST['fecha']);
    $liga=strip_tags($_POST['liga']);
    $enlace = connectionDB();
    $res="<option value='seleccion'>selecione partido</option>";
    $partidos = partidos($enlace,$fecha);
    //0,0 id, 0,1 equiA 0,2 equB, 0,3 liga 0,4 hora
    for($i=0;$i<count($partidos);$i++) {
        $idP=$partidos[$i][0];
        $nomEquiA=$partidos[$i][1];
        $nomEquiB=$partidos[$i][2];
        $nomLiga=$partidos[$i][3];
        $hora=$partidos[$i][4];
        $nomEquiA = nomEquipo($nomEquiA,$enlace);
        $nomEquiB = nomEquipo($nomEquiB,$enlace);
        $nomLiga = nomLiga($nomLiga,$enlace);
        
        $res.="<option value='".$idP."'>".$nomEquiA." VS ".$nomEquiB." - ".$hora."</option>";
    }
    connectionClose($enlace);
    $res.= "<option value='--otro--'>--otro--</option>";
    
    
    //partidos=array();
    
//    foreach($listPartidos as $p){
//       $partido .=$p.' vs ';
//    }
    /*$partidos="<option value='seleccion'>Seleciona partido</option>
                             <option value='partido1'>partidote 1</option>
                             <option value='partido2'>partidote 2</option>
                             <option value='--otro--'>--otrosssss--</option>";*/
    echo( $res);
    //echo($res);
    //echo('<script languaje="JavaScript">var varjs='.$res.';</script>');
}
cmbpartidos();

?>