<?php
//funcion q realiza una coneccion con la bd
function connectionDB(){

    $DB_SERVER='localhost';
    $DB_NAME='apuestas';
    $DB_USER='root';
    $DB_PASS='Jorge1990';
    
    $enlace = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
    if(!$enlace){
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    $enlace=null;
    exit;
    }
//    mysqli_query("SET NAMES 'utf8'");
    $enlace->query("SET NAMES 'utf8'");
    return $enlace;
}
//funcion q termina la coneccion
function connectionClose($enlace){
    mysqli_close($enlace);  
     
}
//valida datos de usurio y redirecciona segun si es admin o asesor
function verificarLogin($user,$enl,$pass){
    $sql = "
    SELECT CONTRASENA,TIPO,ID from persona where USUARIO='".$user."';
    
    ";
    $result = $enl -> query($sql) or die("error al crear conexíon con DB");
    connectionClose($enl);
    if($row=$result->fetch_assoc()){
    
        if(password_verify($pass, $row['CONTRASENA'])){
            session_start();
            $_SESSION['usuario']=$user;
            $_SESSION['tipo']=$row['TIPO'];
            $_SESSION['id']=$row['ID'];
            
        
            if($_SESSION['tipo']=='ADMINISTRADOR'){
                echo("<script>alert('admin');</script>");
                header("location: administrador.php");
            }elseif($_SESSION['tipo']=='ASESOR' || $_SESSION['tipo']=='CLIENTE'){
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
//verificar password
function verificarpassword($enl,$id,$pass){
    $sql="SELECT CONTRASENA from persona WHERE ID='".$id."';";
    $result = $enl->query($sql) or die('error al acceder a DB');
    if($row=$result->fetch_assoc()){
        if(password_verify($pass,$row['CONTRASENA'])){
            return true;
        }else{
            return false;
        }
    }
}
//cambiar contraseña
function cambiarpassword($enl,$pass,$id){
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql= "UPDATE persona SET CONTRASENA='".$pass."' WHERE ID='".$id."';";
    if($enl->query($sql)){
        return true;
    }else{
        return false;
    }
}
//ingresa nuevo personal
function ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$usuario,$password,$tipo,$enl){
    
   //encripta la contraseña
    $contrasena = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "
    INSERT INTO persona VALUES('".$cedula."','".$nombre."','".$apellido."','".$telefono."','".$email."','".$tipo."','".$contrasena."','".$usuario."',NULL);";
    //$enl->query($sql) or die("error al ingresar datos en DB");
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
    $sql = "SELECT ID FROM persona WHERE USUARIO='".$usuario."';";
    $result = $enl->query($sql)or die("error al crear saldo de usuario");
    if($row=$result->fetch_assoc()){
        $idasesor= $row['ID'];
        //echo('<script type="text/javascript">alert("'.$idasesor.'")</script>');
        $sql = "INSERT INTO saldos VALUES('".$idasesor."','0')";
        $enl->query($sql);
    }
    
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
//recibe id de equipo y retorna nombre;
function nomEquipo($id,$enl){
    $nom=null;
    $sql = "SELECT NOMBRE FROM equipos WHERE ID='".$id."'";
    $result = $enl->query($sql) or die ("error al conectar con DB nomEquip");
    if($row=$result->fetch_assoc()){
        $nom = $row['NOMBRE'];
    }
    return $nom;
}
//ingresar equipos
function ingresoEquipos($nombre,$enl){
    $sql = "INSERT INTO equipos VALUES('".$nombre."',NULL);";
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
}
//busca liga si existe retorna id de la liga recibe nombre
function idliga($liga,$enl){
    $idliga=null;
    $sql = "SELECT ID FROM ligas WHERE NOMBRE like '%".$liga."%'";
    $result = $enl->query($sql) or die ("error al conectar con DB");
    if($row=$result->fetch_assoc()){
        $idliga= $row['ID'];
    }
    return $idliga;
}
//recibe id de liga retorna nombre
function nomLiga($id,$enl){
    $nom=null;
    $sql = "SELECT NOMBRE FROM ligas WHERE ID='".$id."'";
    $result = $enl->query($sql) or die ("error al conectar con DB nomliga");
    if($row=$result->fetch_assoc()){
        $nom = $row['NOMBRE'];
    }
    return $nom;
}
//busca un partido y retorna id del mismo
function idpartido($enl,$fechaPartido,$horaP,$idequipoA,$idequipoB,$idliga){
    $sql = "SELECT ID FROM partidos WHERE FECHA='".$fechaPartido."' AND EQUIPOA='".$idequipoA."' AND EQUIPOB = '".$idequipoB."' AND LIGA='".$idliga."';";
    $id=null;
    $result = $enl->query($sql)or die ("error al conectar con DB idPartidos");
    if($row=$result->fetch_assoc()){
        $id=$row['ID'];
    }
    return $id;
}
//ingreso de liga nueva recibe nombre
function ingresoLiga($liga, $enl){
    echo('<script type="text/javascript">alert("'.$liga.'")</script>');
    $sql = "INSERT INTO ligas VALUES('".$liga."',NULL);";
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
}
//ingreso partido
function ingresoPartido($fecha,$hora,$local,$visitante,$idliga,$cuota1,$cuota2,$cuotaX,$enl){
    $horadepartido = $fecha." ".$hora.":00";
//    echo('<script type="text/javascript">alert("'.$horadepartido.'")</script>');
    $sql = "INSERT INTO partidos VALUES('".$fecha."','".$horadepartido."','".$local."','".$visitante."','".$idliga."',NULL,'".$cuota1."','".$cuotaX."','".$cuota2."',NULL);";
    if(!$enl->query($sql)){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        exit();
    }
}
//retorna un array de todas las ligas registrada
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
//retorna listado de equipos
function equipos($enl){
    $sql='SELECT NOMBRE FROM equipos ORDER BY NOMBRE';
    $result = $enl->query($sql)or die("error al cosultar DB");
    $arr = array();
    $i=0;
    while($row=$result->fetch_assoc()){
        $arr[$i]=$row['NOMBRE'];
        $i++;
    }
    return $arr;
}

function partidos($enl,$fecha){
    $sql = "SELECT ID,EQUIPOA,EQUIPOB,LIGA,CUOTA1,CUOTAX,CUOTA2, DATE_FORMAT(HORA, '%T') AS HORAP FROM partidos WHERE FECHA='$fecha' ORDER BY HORA;";
    $result = $enl->query($sql)or die('error al consulta DB');
    $arr = array();
    $i=0;
    while($row=$result->fetch_assoc()){
        $l=0;
        $arr[$i][$l]=$row['ID'];
        $l++;
        $arr[$i][$l]=$row['EQUIPOA'];
        $l++;
        $arr[$i][$l]=$row['EQUIPOB'];
        $l++;
        $arr[$i][$l]=$row['LIGA'];
        $l++;
        $arr[$i][$l]=$row['HORAP'];
        $l++;
        $arr[$i][$l]=$row['CUOTA1'];
        $l++;
        $arr[$i][$l]=$row['CUOTAX'];
        $l++;
        $arr[$i][$l]=$row['CUOTA2'];
        $i++;
        
    }
    return $arr;
}
function nompartido($enl,$idp){
    $sql = "SELECT ID,EQUIPOA,EQUIPOB,LIGA,CUOTA1,CUOTAX,CUOTA2, DATE_FORMAT(HORA, '%T') AS HORAP FROM partidos WHERE ID='".$idp."';";
    $result = $enl->query($sql)or die("error al conectar DB");
    $partido="";
    while($row=$result->fetch_assoc()){
        $partido.=$row['EQUIPOA']."_vs_";
        $partido.=$row['EQUIPOB']." - ";
        $partido.=$row['HORAP'];
    }
    return $partido;
}
function equiposLigaPartido($enl,$idP){
    $sql = "SELECT EQUIPOA,EQUIPOB,LIGA,DATE_FORMAT(HORA, '%T') AS HORAP, GANADOR FROM partidos WHERE ID='".$idP."'";
    $result = $enl->query($sql)or die("error al conectar a DB combosapuestas");
    $arr = array();
    if($row=$result->fetch_assoc()){
        $arr[0]=$row['EQUIPOA'];
        $arr[1]=$row['EQUIPOB'];
        $arr[2]=$row['LIGA'];
        $arr[3]=$row['HORAP'];
        $arr[4]=$row['GANADOR'];
    }
    return $arr;
}
//obtener saldo asesor
function saldo($enl,$id){
    $sql = "SELECT SALDO FROM saldos WHERE IDASESOR='".$id."'";
    $result = $enl->query($sql)or die("error al conectar a DB saldos");
    $saldo='100';
    if($row=$result->fetch_assoc()){
        $saldo=$row['SALDO'];
    }
    return $saldo;
}
function ingresoApuesta($enl,$valor,$idAsesor,$fecha,$idPart,$EquiApost,$idLiga,$cuota,$idapuesta,$saldoDisp){
    $enl->autocommit(false);
    $flag = true;
    $sql = "INSERT INTO apuestas VALUES('".$valor."','".$idAsesor."','".$fecha."','".$idPart."','".$EquiApost."','".$idLiga."','".$cuota."','".$idapuesta."',NULL);";
    $saldoDisp=$saldoDisp-$valor;
    $sql2 = "UPDATE saldos SET SALDO='".$saldoDisp."' WHERE IDASESOR=".$idAsesor.";";
    if(!$enl->query($sql)){
   // if($enl->errno){
        $flag = false;
        echo("Error en transaccion ingreso");
    }
     if(!$enl->query($sql2)){
    //if($enl->errno){
        $flag = false;
        echo("Error en transaccion actualizando");
    }
    if($flag){
        $enl->commit();
        return true;
    }else{
        $enl->rollBack();
        return false;
    }
}
function fechahoraPartido($enl,$id){
    $sql="SELECT HORA FROM partidos WHERE ID='".$id."';";
    $result= $enl->query($sql)or die("Error al consultar DB");
    $hora=0;
    if($row=$result->fetch_assoc()){
        $hora=$row['HORA'];
    }
    return $hora;
}
function listAsesores($enl){
    $sql= "SELECT NOMBRE,SALDO,IDASESOR FROM saldos JOIN persona WHERE(IDASESOR=ID AND TIPO='ASESOR');";
    $ase = array();
    $result = $enl->query($sql)or die('error al consulta DB');
    $i=0;
    //0,0 nombre 0,1 saldo
    while($row=$result->fetch_assoc()){
        $l=0;
        $ase[$i][$l] = $row['NOMBRE'];
        $l++;
        $ase[$i][$l] = $row['SALDO'];
        $l++;
        $ase[$i][$l] = $row['IDASESOR'];
        $i++;
    }
    return $ase;
}
//actualizar cuotas
function actualizarcuotas($enl,$idp,$cuota1,$cuota2,$cuotax){
    $sql="UPDATE partidos SET CUOTA1='".$cuota1."', CUOTA2='".$cuota2."', CUOTAX='".$cuotax."' WHERE ID='".$idp."'";
    if($enl->query($sql)){
        return true;
    }else{
        return false;
    }
}
function apuestass($enl,$ida){
    $sql= "SELECT DISTINCT ID,CUOTA,VALOR,IDASESOR,IDPARTIDO,APUESTA FROM apuestas WHERE(ID='".$ida."');";
    $ase = array();
    $result = $enl->query($sql)or die('error al consulta DB');
    $i=0;
    //0,0 nombre 0,1 saldo
    while($row=$result->fetch_assoc()){
        $l=0;
        $ase[$i][$l] = $row['ID'];
        $l++;
        $ase[$i][$l] = $row['CUOTA'];
        $l++;
        $ase[$i][$l] = $row['VALOR'];
         $l++;
        $ase[$i][$l] = $row['IDASESOR'];
         $l++;
        $ase[$i][$l] = $row['IDPARTIDO'];
         $l++;
        $ase[$i][$l] = $row['APUESTA'];
        $i++;
    }
    return $ase;
}

function asesor($enl,$id){
    $sql="SELECT NOMBRE FROM persona WHERE ID='".$id."';";
    $result= $enl->query($sql)or die("Error al consultar DB");
    $i=0;
    $ase=array();
    //0,0 nombre 0,1 saldo
    while($row=$result->fetch_assoc()){
        
        $ase[$i] = $row['NOMBRE'];
       
        $i++;
    }
    return $ase;
}
function acfecha($enl,$idu){
    $sql="SELECT  fechaA, fechaB, ID FROM fecha WHERE(ID='".$idu."');";
    $result= $enl->query($sql)or die("Error al consultar DB");
    $i=0;
    $ase = array();
    
        $ase[0]=NULL;
        $ase[1]=NULL;
        $ase[2]=0;
    while($row=$result->fetch_assoc()){
        $ase[0] = $row['fechaA'];
        $ase[1] = $row['fechaB'];
        $ase[2] = $row['ID'];
        
    }
    return $ase;
}


function tpersona($enl){
    $sql="SELECT  NOMBRE, ID FROM persona WHERE TIPO!='ADMINISTRADOR';";
    $result= $enl->query($sql)or die("Error al consultar DB");
    $i=0;
    $ase = array();
    while($row=$result->fetch_assoc()){
        $ase[$i][0] = $row['NOMBRE'];
        $ase[$i][1] = $row['ID'];
        $i++;
        
    }
    return $ase;
}

function idapuesta($enl,$fecha1,$fecha2){
    $sql="SELECT  DISTINCT ID,VALOR,IDASESOR FROM apuestas WHERE(FECHA>='".$fecha1."' AND FECHA<='".$fecha2."');";
    $result= $enl->query($sql)or die("Error al consultar DB");
    $i=0;
    $ase = array();
    while($row=$result->fetch_assoc()){
        $ase[$i][0] = $row['ID'];
        $ase[$i][1] = $row['VALOR'];
        $ase[$i][2] = $row['IDASESOR'];
        $i++;
        
    }
    return $ase;
}


?>