<?php
$usuario = $_POST['usuario'];
$pass = $_POST['password'];

if(empty($usuario)||empty($pass)){
    header("location: index.html");
    exit();
}
define('DB_SERVER','localhost');
define('DB_NAME','apuestas');
define('DB_USER','root');
define('DB_PASS','Jorge1990');
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

/*en versiones de php 7 se usa la siguiente instruccion*/
$enlace = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "SELECT CONTRASENA,TIPO from persona where USUARIO='".$usuario."'";
$result = $enlace -> query($sql) or die("error al crear conexíon con DB");
  
/*while($row = $result->fetch_assoc()){
    $datos[] = $row;
    
}
print_r($datos);
echo $row[CONTRASENA];*/
if($row=$result->fetch_assoc()){
    
    if($row[CONTRASENA]==$pass){
        session_start();
        $_SESSION['usuario']=$usuario;
        $_SESSION['tipo']=$row[TIPO];
        $_SESSION['logeado']='si';
        if($_SESSION['tipo']=='ADMINISTRADOR'){
            ("location: administrador.php");
        }elseif($_SESSION['tipo']=='ASESOR'){
            header("location: asesor.html");
        }
        
    }else{
        header("Location: index.html");
        exit();
    }
}else{
    header("location: index.html");
    exit();
}

?>