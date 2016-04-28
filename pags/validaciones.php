<?php
require_once('gestionDB.php');
    function validarAdmin(){
        session_start();
    if ($_SESSION['tipo']!='ADMINISTRADOR') { 
        header('location: dennyAcces.html');
        exit;
    }
    }

    function validarAsesor(){
        session_start();
    if (!$_SESSION['tipo']) { 
        header('location: dennyAcces.html');
        exit;
    }
    }
    function validaruser($user, $enlace){
        if(usuarios($user,$enlace)){
            return true;
        }else{
            return false;
        }
        
    }
function validarcedula($cedula,$enlace){
    if(cedulas($cedula,$enlace)){
        return true;
    }else{return false;}
}

//limíar cadenas no se termino 
function limpiarcadenas($cadena){
    $cadena=strip_tags($cadena);
    $cadena=htmlentities($cadena);
    return stripslashes($cadena);
}
?>