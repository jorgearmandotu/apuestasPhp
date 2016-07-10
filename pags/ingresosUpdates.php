<?php
require_once('gestionDB.php');
require_once('validaciones.php');
validarAdmin();
//funcion q llama las demas funciones que necesita paa ingresar al personal


function ingresarAsesor(){
    $nombre=limpiarcadenas($_POST['nombre']);
    $nombre=strtoupper($nombre);
    $apellido=limpiarcadenas($_POST['apellido']);
    $apellido=strtoupper($apellido);
    $cedula=limpiarcadenas($_POST['cedula']);
    $telefono=limpiarcadenas($_POST['telefono']);
    $email=limpiarcadenas($_POST['email']);
    $idUsuario = limpiarcadenas($_POST['usuario']);
    $idUsuario = strtoupper($idUsuario);
    $password=limpiarcadenas($_POST['password']);
    $passverificar=limpiarcadenas($_POST['passwordverificacion']);
    $punto=limpiarcadenas($_POST['punto']);
    $tipo='0';
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
            if(ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$idUsuario,$password,$tipo,$enlace,$punto)){
                ConnectionClose($enlace);
                return true;
            }else{
                ConnectionClose($enlace);
                return false;
            }
        }
        
    }else{echo ' <script type="text/javascript">alert("ocurrio un error buelbe a intentarlo")</script>';}
    
}

if(ingresarAsesor()){
    echo ' <script type="text/javascript">alert("ingreso exitoso")</script>';
}else{
    echo ' <script type="text/javascript">alert("ocurrio un problema buelva a intentarlo")</script>';
}

?>