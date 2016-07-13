<?php
require_once '../gestionDB.php';
require_once '../validaciones.php';

validarAdmin();

//ingreso ligas
if(isset($_POST['nliga']) and isset($_POST['npais'])){
    $nomliga = limpiarcadenas($_POST['nliga']);
    $paisliga = limpiarcadenas($_POST['npais']);
    
    if($nomliga=='' or $paisliga==''){
        echo '<script type="text/javascript">alert("verifique datos")</script>';
    }else{
        $enlace = connectionDB();
        $enlace->autocommit('false');
        if(!verificarliga($nomliga,$paisliga,$enlace)){
            if(ingresoLiga($nomliga,$paisliga,$enlace)){
                $enlace->commit();
                echo '<script type="text/javascript">alert("liga ingresada")</script>';
            }else{
                $enlace->rollBack();
                echo '<script type="text/javascript">alert("ocurrio un error intentelo  de nuevo")</script>';
            }
        }else{
            $enlace->rollBack();
            echo '<script type="text/javascript">alert("liga ya existe")</script>';
        }
        connectionClose($enlace);
    }
}

//ingreso equipos
if(isset($_POST['nequipo']) and isset($_POST['ligaselec'])){
    $nomequipo = limpiarcadenas($_POST['nequipo']);
    $idliga = limpiarcadenas($_POST['ligaselec']);
    
    if($idliga == 'seleccione liga' or $idliga == '' or $nomequipo==''){
        echo '<script type="text/javascript">alert("verifique datos")</script>';
        //header('location:../gestion_ligas_equipos.php');
    }else{
        $enlace = connectionDB();
        $enlace->autocommit('false');
        if(!verificarequipo($nomequipo,$idliga,$enlace)){
            if(ingresoEquipos($nomequipo,$idliga,$enlace)){
                $enlace->commit();
                echo '<script type="text/javascript">alert("equipo ingresado")</script>';
            }else{
                $enlace->rollBack();
                echo '<script type="text/javascript">alert("ocurrio un error intentelo nuevamente")</script>';
            }
        }else{
            $enlace->rollBack();
            echo '<script type="text/javascript">alert("equipo ya existe")</script>';
        }
            connectionClose($enlace);
    }
}

?>