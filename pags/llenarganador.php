<?php
require_once('gestionDB.php');
require_once('validaciones.php');
if(!validarsession()){
            header('location: ../index.php');
        }
use Carbon\Carbon;
function cmbpartidos(){
$fecha=strip_tags($_POST['fecha']);

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
        
        
        $res.="<option value='".$idP."'>".$nomEquiA." VS ".$nomEquiB." - ".$hora."</option>";
    }
    connectionClose($enlace);
    echo( $res);
}
cmbpartidos();
?>