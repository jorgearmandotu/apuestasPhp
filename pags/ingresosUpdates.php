<?php
require_once('gestionDB.php');
require_once('validaciones.php');

//funcion q llama las demas funciones que necesita paa ingresar al personal
function ingresarAsesor(){
    $nombre=strip_tags($_POST['nombre']);
    $apellido=strip_tags($_POST['apellido']);
    $cedula=strip_tags($_POST['cedula']);
    $telefono=strip_tags($_POST['telefono']);
    $email=strip_tags($_POST['email']);
    $usuario=strip_tags($_POST['usuario']);
    $idUsuario = strtoupper($usuario);
    $password=strip_tags($_POST['password']);
    
    $enlace=connectionDB();
    if($enlace!=null){
        if(validaruser($idUsuario,$enlace)){
             echo (' <script type="text/javascript">alert("usario ya existe elija otro")</script>');
            return false;
            connectionClose($enlace);
            exit();
        }elseif(validarcedula($cedula,$enlace)){
            echo (' <script type="text/javascript">alert("cedula de usuario ya existe")</script>');
            return false;
            connectionClose($enlace);
            exit();
        }
        else{
            ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$idUsuario,$password,$enlace);
            ConnectionClose($enlace);
            return true;
        }
        
    }else{echo ' <script type="text/javascript">alert("ocurrio un error buelbe a intentarlo")</script>';}
    
}

if(ingresarAsesor()){
    echo ' <script type="text/javascript">alert("ingreso exitoso")</script>';
}

?>