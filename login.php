<?php
$usuario = $_POST['usuario'];
$pass = $_POST['password'];

if(empty($usuario)|| empty($pass)){
    header("location: index.html");
    exit();
}
define('DB_SERVER','localhost');
define('DB_NAME','apuestas');
define('DB_USER','root');
define('DB_PASS','Jorge1990');

mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Error al conectar con bd ". mysql_error());
mysql_select_db(DB_NAME) or die ("Error al seleccionar la base de datos: ". mysql_error());

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

?>