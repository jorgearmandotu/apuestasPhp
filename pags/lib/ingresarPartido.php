<?php
require_once 'gestionDB.php';
require_once 'validaciones.php';

function ingresarPartido(){
    $local=limpiarcadenas($_POST['equipoA']);
    $visitante=limpiarcadenas($_POST['equipoB']);
    $liga=limpiarcadenas($_POST['liga']);
    $fecha=limpiarcadenas($_POST['fecha']);
    $hora=limpiarcadenas($_POST['hora']);
    $cuota1=limpiarcadenas($_POST['cuota1']);
    $cuota2=limpiarcadenas($_POST['cuota2']);
    $cuotaX=limpiarcadenas($_POST['cuotaX']);
    
    $enlace=connectionDB();
    if($enlace != null){
        /*buscar id de liga*/
        $idliga=idliga($liga,$enlace);
        if($idliga==null){
             echo (' <script type="text/javascript">alert("ocurrio un problema en liga seleccionada")</script>');
            return false;
            connectionClose($enlace);
            exit();
        }else{
            ingresoPartido($fecha,$hora,$local,$visitante,$idliga,$cuota1,$cuota2,$cuotaX,$enl)
        }
        
    }
}

?>