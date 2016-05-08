<?php
require_once('gestionDB.php');
require_once('validaciones.php');

//funcion q llama las demas funciones que necesita paa ingresar al personal


function ingresarAsesor(){
    $nombre=limpiarcadenas($_POST['nombre']);
    $apellido=limpiarcadenas($_POST['apellido']);
    $cedula=strip_tags($_POST['cedula']);
    $telefono=strip_tags($_POST['telefono']);
    $email=strip_tags($_POST['email']);
    $idUsuario = limpiarcadenas($_POST['usuario']);
    $password=strip_tags($_POST['password']);
    $passverificar=strip_tags($_POST['passwordverificacion']);
    $tipo=strip_tags($_POST['tipo']);
    
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
        }elseif($password!=$passverificar){
            echo (' <script type="text/javascript">alert("las contraseñas no coinciden")</script>');
            return false;
            connectionClose($enlace);
            exit();
        }
        else{
            ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$idUsuario,$password,$tipo,$enlace);
            ConnectionClose($enlace);
            return true;
        }
        
    }else{echo ' <script type="text/javascript">alert("ocurrio un error buelbe a intentarlo")</script>';}
    
}

if(ingresarAsesor()){
    echo ' <script type="text/javascript">alert("ingreso exitoso")</script>';
}

?>