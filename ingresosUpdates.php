<?php
require_once('gestionDB.php');

function ingresarAsesor(){
    $nombre=strip_tags($_POST['nombre']);
    $apellido=strip_tags($_POST['apellido']);
    $cedula=strip_tags($_POST['cedula']);
    $telefono=strip_tags($_POST['telefono']);
    $email=strip_tags($_POST['email']);
    $idUsuario=strip_tags($_POST['usuario']);
    $password=strip_tags($_POST['password']);
    
    $enlace=connectionDB();
    if($enlace!=null){
        ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$idUsuario,$password,$enlace);
        return true;
    }
    
}

if(ingresarAsesor()){
    echo ' <script type="text/javascript">alert("ingreso exitoso")</script>';
}else{
    echo ' <script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>';
}

?>