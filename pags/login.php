<?php
require_once('gestionDB.php');

$idusuario = $_POST['usuario'];
$usuario = strtoupper($idusuario);
$pass = $_POST['password'];

if(empty($usuario)||empty($pass)){
    header("location: ../index.html");
    exit();
}
$enlace=connectionDB();
if($enlace!=null){
    verificarLogin($usuario,$enlace,$pass);
}


/*solo funciona en php version anteriorre a 7 ya q fue eliminada*/
/*mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Error al conectar con bd ". mysql_error());
mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Error al conectar con bd ". mysql_error());
mysql_select_db(DB_NAME) or die("Error al seleccionar la base de datos: ". mysql_error());


$result = mysql_query("SELECT * from persona where USUARIO='".$usuario."'");

if($row=mysql_fetch_array($result)){
    if($row['CONTRASENA']==$pass){
        session_start();
        $_SESSION['usuario']=$usuario;
        header("location: index2.php");
    }else{
        header("Location: index.html");
        exit();
    }
}else{
    header("location: index.html");
    exit();
}

/*en versiones de php 7 se usa mysqli*/  

?>