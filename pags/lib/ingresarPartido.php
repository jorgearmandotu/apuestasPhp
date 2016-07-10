<?php
require_once '../gestionDB.php';
require_once '../validaciones.php';

validarAdmin();

function ingresarPartido(){
    $local=limpiarcadenas($_POST['equipoA']);
    $local=strtoupper($local);
    $visitante=limpiarcadenas($_POST['equipoB']);
    $visitante=strtoupper($visitante);
    //$liga=limpiarcadenas($_POST['liga']);
    $fecha=limpiarcadenas($_POST['fecha']);
    $hora=limpiarcadenas($_POST['hora']);
    $cuota1=limpiarcadenas($_POST['cuota1']);
    $cuota2=limpiarcadenas($_POST['cuota2']);
    $cuotaX=limpiarcadenas($_POST['cuotaX']);
    $fechah = $fecha.' '.$hora.':00';
    $enlace=connectionDB();
    if($enlace != null){
        /*buscar id de liga*/
        //$idliga=idliga($liga,$enlace);
        //$idpartido=null;
        
        $idpartido = idpartido($enlace,$fechah,$local,$visitante);
        if($idpartido!=null){
             echo (' <script type="text/javascript">alert("partido ya existe verifique datos")</script>');
            
            connectionClose($enlace);
            exit();
        }else{
            if(ingresoPartido($fechah,$local,$visitante,$cuota1,$cuota2,$cuotaX,$enlace)){
            connectionClose($enlace);
                echo '<script type="text/javascript">alert("ingreso exitoso")</script>';
                //return true;
            }else{
                echo '<script type="text/javascript">alert("ocurrio un error verifique datos")</script>';
                //return false;
            }
        }
        
    }
}
ingresarPartido();
?>