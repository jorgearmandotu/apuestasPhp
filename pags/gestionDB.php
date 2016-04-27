<?php
//funcion q realiza una coneccion con la bd
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
//funcion q termina la coneccion
function connectionClose($enlace){
    mysqli_close($enlace);
}
//valida datos de usurio y redirecciona segun si es admin o asesor
function verificarLogin($user,$enl,$pass){
    $sql = "
    SELECT CONTRASENA,TIPO from persona where USUARIO='".$user."';
    
    ";
    $result = $enl -> query($sql) or die("error al crear conexíon con DB");
    connectionClose($enl);
    if($row=$result->fetch_assoc()){
    
        if(password_verify($pass, $row['CONTRASENA'])){
            session_start();
            $_SESSION['usuario']=$user;
            $_SESSION['tipo']=$row[TIPO];
        
            if($_SESSION['tipo']=='ADMINISTRADOR'){
                echo("<script>alert('admin');</script>");
                header("location: administrador.php");
            }elseif($_SESSION['tipo']=='ASESOR'){
                echo("<script>alert('asesor');</script>");
            header("location: asesor.php");
            }
        
        }else{
            header("Location: ../index.html");
            exit();
        }
    }else{
        header("location: ../index.html");
        exit();
    }
}

//ingresa nuevo personal
function ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$usuario,$password,$enl){
    
   //encripta la contraseña
    $contrasena = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO persona VALUES('".$cedula."','".$nombre."','".$apellido."','".$telefono."','".$email."','ASESOR','".$contrasena."','".$usuario."',NULL);";
    //$enl->query($sql) or die("error al ingresar datos en DB");
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
    connectionClose($enl);
}
// valida si id de usuario ya existe
function usuarios($user,$enl){
    $sql = "SELECT USUARIO from persona WHERE USUARIO='".$user."'";
    $result = $enl-> query($sql)or die("error al crear coneccion con DB");
    if($row=$result->fetch_assoc()){
        return true;
    }else{
        return false;
    }
}
// valida la existencia de cedula
function cedulas($ced,$enl){
    $sql = "SELECT CC from persona WHERE CC='".$ced."'";
    $result = $enl->query($sql)or die("error al crear coneccion con DB");
    if($row=$result->fetch_assoc()){
        return true;
    }else{
        return false;
    }
}
//busca exixstencia de equipo y retorna id

function equipo($equipo, $enl){
    $idEquipo = null;
    $sql = "SELECT ID FROM equipos WHERE NOMBRE like '%".$equipo."%'";
    $result = $enl->query($sql) or die("error al conectar con DB");
    if($row=$result->fetch_assoc()){
        $idEquipo = $row['ID'];
    }
    return $idEquipo;
}
//ingresar equipos
function ingresoEquipos($nombre,$enl){
    $sql = "INSERT INTO equipos VALUES('".$nombre."',NULL);";
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
}
//busca liga si existe retorna id de la liga
function idliga($liga,$enl){
    $idliga=null;
    $sql = "SELECT ID FROM ligas WHERE NOMBRE like '%".$liga."%'";
    $result = $enl->query($sql) or die ("error al conectar con DB");
    if($row=$result->fetch_assoc()){
        $idliga= $row['ID'];
    }
    return $idliga;
}
//busca un partido y retorna id del mismo
function idpartido($fechaPartido,$horaP,$idequipoA,$idequipoB,$idliga){
    $sql = "SELECT ID FROM partidos WHERE FECHA='".$fechaPartido."' AND EQUIPOA='".$idequipoA."'";
    $id=null;
    return $id;
}
//ingreso de liga nueva recibe nombre
function ingresoLiga($liga, $enl){
    $sql = "INSERT INTO ligas VALUES('".$liga."',NULL);";
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
}
//ingreso partido
function ingresoPartido($fechaPartido,$hora,$idequipoA,$idequipoB,$idliga,$enl){
    $sql = "INSERT INTO partidos VALUES('".$fechaPartido."','".$fechaPartido." ".$hora."00','".$idequipoA."','".$idequipoB."','".$idliga."',NULL,NULL);";
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
}
function ligas($enl){
    $sql = 'SELECT NOMBRE FROM ligas ORDER BY NOMBRE;';
    $result = $enl->query($sql)or die('error al consutar BD');
    $arr = array();
    $i=0;
    while($row=$result->fetch_assoc()){
        $arr[$i]=$row['NOMBRE'];
        $i++;
    }
    return $arr;
}
function partidos($enl,$fecha){
    $sql = "SELECT equipos.NOMBRE FROM partidos JOIN equipos JOIN ligas WHERE FECHA='".$fecha."' and ligas.NOMBRE='liga 1'";
    $result = $enl->query($sql)or die('error al consulta DB');
    $arr = array();
    $i=0;
    while($row=$result->fetch_assoc()){
        $arr[$i]=$row['NOMBRE'];
        $i++;
    }
    return $arr;
}
?>