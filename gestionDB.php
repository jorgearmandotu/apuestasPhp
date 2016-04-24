<?php

function connectionDB(){
    define('DB_SERVER','localhost');
    define('DB_NAME','apuestas');
    define('DB_USER','root');
    define('DB_PASS','Jorge1990');
    
    $enlace = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    $enlace=null;
    exit;
    }
    return $enlace;
}
function connectionClose($enlace){
    mysqli_close(mysqli $enlace);
}

function verificarLogin($user,$enl,$pass){
    $sql = "SELECT CONTRASENA,TIPO from persona where USUARIO='".$user."'";
    $result = $enl -> query($sql) or die("error al crear conexíon con DB");
    
    if($row=$result->fetch_assoc()){
    
        if($row['CONTRASENA']==$pass){
            session_start();
            $_SESSION['usuario']=$user;
            $_SESSION['tipo']=$row[TIPO];
        
            echo("<script>alert('hola');</script>");
            if($_SESSION['tipo']=='ADMINISTRADOR'){
                echo("<script>alert('admin');</script>");
                header("location: administrador.php");
            }elseif($_SESSION['tipo']=='ASESOR'){
                echo("<script>alert('asesor');</script>");
            header("location: asesor.php");
            }
        
        }else{
            header("Location: index.html");
            exit();
        }
    }else{
        header("location: index.html");
        exit();
    }
}

?>