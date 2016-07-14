<?php
//funcion q realiza una coneccion con la bd
function connectionDB(){

    $DB_SERVER='localhost';
    $DB_NAME='apuestasdb';
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
    if($sql = $enl->prepare("
    SELECT contrasena,administrador,cc from asesores where USUARIO=?;
    
    ")){
        
    $sql->bind_param('s',$user);
    $sql->execute();
    $sql->bind_result($contrasena,$tp,$idunica);
    if($sql->fetch()){
        //$sql->fetch();
        if(password_verify($pass, $contrasena)){
            session_start();
            $_SESSION['usuario']=$user;
            $_SESSION['tipo']=$tp;
            $_SESSION['id']=$idunica;
            
        
            if($_SESSION['tipo']=='1'){
                echo("<script>alert('admin');</script>");
                header("location: administrador.php");
            }elseif($_SESSION['tipo']=='0'){
                echo("<script>alert('asesor');</script>");
            header("location: asesor.php");
            }
        
        }else{
            header("Location: ../index.php");
            exit();
        }
    }else{
        header("location: ../index.php");
        exit();
    }
}
}
//verificar password
function verificarpassword($enl,$id,$pass){
    
    if($sql= $enl->prepare("SELECT CONTRASENA from asesores WHERE cc=?;")){
    $sql->bind_param('s',$id);
    $sql->execute();
    $sql->bind_result($contrasena);
    
    if($sql->fetch()){
        //$sql->fetch();
        if(password_verify($pass,$contrasena)){
            return true;
        }else{
            return false;
        }
    }
}
}
//cambiar contraseña
function cambiarpassword($enl,$pass,$id){
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    if($sql= $enl->prepare("UPDATE asesores SET CONTRASENA=? WHERE cc=?;")){
        $sql->bind_param('ss',$pass,$id);
    if($sql->execute()){
        return true;
    }else{
        return false;
    }
}
}
//ingresa nuevo personal
function ingresarPersona($nombre,$apellido,$cedula,$telefono,$email,$usuario,$password,$tipo,$enl,$punto){
    
   //encripta la contraseña
    $contrasena = password_hash($password, PASSWORD_DEFAULT);
    
    if($sql = $enl->prepare("
    INSERT INTO asesores VALUES(?,?,?,?,?,?,?,?,?,0);")){
    $sql->bind_param('sssssssss',$cedula,$nombre,$apellido,$email,$telefono,$tipo,$usuario,$contrasena,$punto);
    if(!$sql->execute()){
        echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');
        header('index.php');
        exit();
    }
        return true;
    }
    else{
        return false;
    }
}
// valida si id de usuario ya existe
function usuarios($user,$enl){
    if($sql = $enl->prepare("SELECT USUARIO from asesores WHERE USUARIO=?;")){
    $sql->bind_param('s',$user);
        $sql->execute();
        $sql->bind_result($nuser);
    if($sql->fetch()){
        return true;
    }else{
        return false;
    }
}}
// valida la existencia de cedula
function cedulas($ced,$enl){
    if($sql = $enl->prepare("SELECT CC from asesores WHERE cc=?")){
        $sql->bind_param('s',$ced);
        $sql->execute();
        $sql->bind_result($cedpersona); 
    if($sql->fetch()){
        return true;
    }else{
        return false;
    }
}}
//busca exixstencia de equipo y retorna id

function equipo($equipo, $enl){
    $idEquipo = null;
    if($sql = $enl->prepare("SELECT ID FROM equipos WHERE NOMBRE=?;")){
    $sql->bind_param('s',$equipo);
        $sql->execute();
        $sql->bind_result($idequ);
    if($sql->fetch()){
        $idEquipo = $idequ;
    }}
    return $idEquipo;
}
//recibe id de equipo y retorna nombre;
function nomEquipo($id,$enl){
    $nom='';
    if($sql = $enl->prepare("SELECT nombre FROM equipo WHERE idequipo=?")){
    $sql->bind_param('s',$id);
        $sql->execute();
        $sql->bind_result($nequip);
    if($sql->fetch()){
        $nom = $nequip;
    }}
    return $nom;
}

//ingresar equipos
function ingresoEquipos($nombre,$idliga,$enl){
    $sql = "SELECT MAX(idequipo) FROM equipo";
    if($enl->query($sql)){
        $id=$enl->query($sql)or die('error al consultar DB');
        $res='';
        while($row=$id->fetch_assoc()){
        $res=$row['MAX(idequipo)'];
        }
        $id=$res+1;
        
        if($sql2 = $enl->prepare('INSERT INTO equipo VALUES(?,?,?);')){
            $sql2->bind_param('isi',$id,$nombre,$idliga);
            if($sql2->execute()){
                
                return true;
            }
            else{
                
                return false;
            }
        }
    }else{
        
        return false;
    }
}
//busca liga si existe retorna id de la liga recibe nombre
function idliga($liga,$enl){
    $idliga=null;
    if($sql = $enl->prepare("SELECT ID FROM ligas WHERE NOMBRE = ?")){
        $sql->bind_param('s',$liga);
        $sql->execute();
    $sql->bind_result($idlig);
    if($sql->fetch()){
        $idliga= $idlig;
    }}
    return $idliga;
}
//recibe id de liga retorna nombre
function nomLiga($id,$enl){
    $nom=null;
    if($sql = $enl->prepare("SELECT NOMBRE FROM ligas WHERE ID=?;")){
        $sql->bind_param('s',$id);
        $sql->execute();
        $sql->bind_result($nlig);
    if($sql->fetch()){
        $nom = $nlig;
    }
    return $nom;
}}
//busca un partido y retorna id del mismo
function idpartido($enl,$horarioPartido,$idequipoA,$idequipoB){
    if($sql = $enl->prepare("SELECT idpartido FROM partidos WHERE idpartido=?;")){
        $var = $horarioPartido.'_'.$idequipoA.'_'.$idequipoB;
        $sql->bind_param('s',$var);
    $id=null;
        $sql->execute();
        $sql->bind_result($idpartido);
    if($sql->fetch()){
        $id=$idpartido;
    }
    return $id;
}}
//ingreso de liga nueva recibe nombre
function ingresoLiga($liga,$pais,$enl){
    $sql = "SELECT MAX(idliga) FROM ligas";
    if($enl->query($sql)){
        $id=$enl->query($sql)or die('error al consultar DB');
        $res='';
        while($row=$id->fetch_assoc()){
        $res=$row['MAX(idliga)'];
        }
        $id=$res+1;
        
        if($sql2 = $enl->prepare('INSERT INTO ligas VALUES(?,?,?);')){
            $sql2->bind_param('iss',$id,$liga,$pais);
            if($sql2->execute()){
                
                return true;
            }
            else{
                
                return false;
            }
        }
    }else{
        
        return false;
    }
}
//ingreso partido
function ingresoPartido($horario,$local,$visitante,$cuota1,$cuota2,$cuotaX,$enl){
    //$horadepartido = $fecha." ".$hora.":00";
//    echo('<script type="text/javascript">alert("'.$horadepartido.'")</script>');
    if($sql = $enl->prepare( "INSERT INTO partidos VALUES(?,?,?,?,?,?,?,NULL);")){
        $idpartido=$horario.'_'.$local.'_'.$visitante;
        $sql->bind_param('sssssss',$idpartido,$local,$visitante,$horario,$cuota1,$cuota2,$cuotaX);
        
    if(!$sql->execute()){
        /*echo('<script type="text/javascript">alert("ocurrio un error buebe a intentarlo, si el problema persiste intenta en cerrar sesion e iniciarla de nuevo")</script>');*/
        return false;
        exit();
    }else{return true;}
}}
//retorna un array de todas las ligas registrada filtradas por pais
function ligas($enl,$pais){
    if($sql = $enl->prepare('SELECT NOMBRE,idliga FROM ligas where pais=? ORDER BY NOMBRE;')){
        $sql->bind_param('s',$pais);
        $sql->execute();
        $sql->bind_result($nom,$id);
        $arr = array();
        $i=0;
        while($sql->fetch()){
            $arr[$i][0]=$nom;
            $arr[$i][1]=$id;
            $i++;
        }
        return $arr;
    }
}
//retorna listado de equipos
function equipos($enl, $liga){
    if($sql= $enl->prepare('SELECT NOMBRE,idequipo FROM equipo where id_liga=? ORDER BY NOMBRE;')){
        $sql->bind_param('s',$liga);
        $sql->execute();
        $sql->bind_result($nom,$id);
        $arr = array();
        $i=0;
        while($sql->fetch()){
            $arr[$i][0]=$nom;
            $arr[$i][1]=$id;
            $i++;
        }
        return $arr;
    }
    
    }
//reorna iformacion de partidos
function partidos($enl,$fecha,$horA){
    if($sql = $enl->prepare("SELECT idpartido,equipoa,equipob,cuota1,cuotax,cuota2, DATE_FORMAT(horario, '%T') AS HORAP FROM partidos WHERE horario LIKE ? AND horario >?  ORDER BY horario;
")){
        $fecha=$fecha.'%';
    $sql->bind_param('ss',$fecha,$horA);
        $sql->execute();
        $sql->bind_result($idpa,$equiA,$equiB,$cuo1,$cuox,$cuo2,$horp);
    $arr = array();
    $i=0;
    while($sql->fetch()){
        $l=0;
        $arr[$i][$l]=$idpa;
        $l++;
        $arr[$i][$l]=$equiA;
        $l++;
        $arr[$i][$l]=$equiB;
        $l++;
//        $arr[$i][$l]=$equiB;//anterior liga
//        $l++;
        $arr[$i][$l]=$horp;
        $l++;
        $arr[$i][$l]=$cuo1;
        $l++;
        $arr[$i][$l]=$cuox;
        $l++;
        $arr[$i][$l]=$cuo2;
        $i++;
        
    }
    return $arr;
}}
//sobreescribir metodo del anterior
function partidoslig($enl,$fecha,$liga,$horA){
    if($sql = $enl->prepare("SELECT idpartido,equipoa,equipob,id_liga,CUOTA1,CUOTAX,CUOTA2, DATE_FORMAT(horario, '%T') AS HORAP FROM partidos join equipo WHERE idequipo=equipoa and horario like ? AND id_liga=? AND horario >? ORDER BY horario;")){
        $fecha=$fecha.'%';
        $sql->bind_param('sss',$fecha,$liga,$horA);
    $sql->execute();
        $sql->bind_result($idpa,$equiA,$equiB,$lig,$cuo1,$cuox,$cuo2,$horp);
    $arr = array();
    $i=0;
    while($sql->fetch()){
        $l=0;
        $arr[$i][$l]=$idpa;
        $l++;
        $arr[$i][$l]=$equiA;
        $l++;
        $arr[$i][$l]=$equiB;
        $l++;
        $arr[$i][$l]=$horp;
        $l++;
        $arr[$i][$l]=$cuo1;
        $l++;
        $arr[$i][$l]=$cuox;
        $l++;
        $arr[$i][$l]=$cuo2;
        $i++;
        $arr[$i][$l]=$lig;
        
    }
    return $arr;
}}

//retorna arreglo para armar nombre de partido con horario
function infopartido($enl,$idp){
    $partido = null;
    //if($sql = $enl->prepare("SELECT idpartido,EQUIPOA,EQUIPOB,CUOTA1,CUOTAX,CUOTA2, DATE_FORMAT(horario, '%T') AS HORAP FROM partidos WHERE idpartido=?;")){
    if($sql = $enl->prepare("SELECT idpartido,equipoa,equipob,CUOTA1,CUOTAX,CUOTA2,horario FROM partidos WHERE idpartido=?;")){
        $sql->bind_param('s',$idp);
        $sql->execute();
    $sql->bind_result($idpa,$equiA,$equiB,$cuo1,$cuox,$cuo2,$horp);
    $partido=array();
    while($sql->fetch()){
        $partido[0]=$equiA;
        $partido[1]=$equiB;
        $partido[2]=$horp;//." - ";
        //$partido.=$horp;
    }
    return $partido;
}
}
//retorna partido y su ganador
function equiposLigaPartido($enl,$idP){
    if($sql = $enl->prepare("SELECT equipoa,equipob,DATE_FORMAT(horario, '%T') AS HORAP, resultado, horario FROM partidos WHERE idpartido=?")){
    $sql->bind_param('s',$idP);
        $sql->execute();
        $sql->bind_result($equiA,$equiB,$horp,$ganad,$fechap);
    $arr = array();
    if($sql->fetch()){
        $arr[0]=$equiA;
        $arr[1]=$equiB;
        $arr[2]=$horp;
        $arr[3]=$ganad;
        $arr[4]=$fechap;
    }
    return $arr;
}}
//obtener saldo asesor
function saldo($enl,$id){
    if($sql = $enl->prepare("SELECT SALDO FROM asesores WHERE cc=?")){
        $sql->bind_param('s',$id);
        $sql->execute();
        $sql->bind_result($saldA);
    $saldo='0';
    if($sql->fetch()){
        $saldo=$saldA;
    }
    return $saldo;
}}
//las siguientes 3 funciones ingresan apuesta
function ingresoApuesta($enl,$idAsesor,$fecha,$idapuesta,$valor){
    //$enl->autocommit(false);
    $flag = true;
    if($sql = $enl->prepare("INSERT INTO apuestas VALUES(?,?,?,?);")){
        $sql->bind_param('ssss',$idapuesta,$fecha,$idAsesor,$valor);    
   
    if(!$sql->execute()){
   // if($enl->errno){
        $flag = false;
        echo("Error en transaccion ingreso apuesta");
    }}
    if($flag){
        //$enl->commit();
        return true;
    }else{
        //$enl->rollBack();
        return false;
    }
}
function apuestasaldo($enl,$saldoDisp,$idAsesor,$valor){
    $flag = true;
    if($sql2 = $enl->prepare("UPDATE asesores SET SALDO=? WHERE cc=?;")){
        $saldoDisp=$saldoDisp-$valor;
         $sql2->bind_param('ss',$saldoDisp,$idAsesor);
     
     if(!$sql2->execute()){
    //if($enl->errno){
        $flag = false;
        echo("Error en transaccion actualizando");
    }}
    if($flag){
        //$enl->commit();
        return true;
    }else{
        //$enl->rollBack();
        return false;
    }
}
function insertpartido_apuesta($enl,$idPart,$idapuesta,$EquiApost,$cuota){
    $flag = true;
    if($sql3= $enl->prepare("INSERT INTO partido_apuesta VALUES(?,?,?,?);")){
        $sql3->bind_param('ssss',$idPart,$idapuesta,$EquiApost,$cuota);
        if(!$sql3->execute()){
            $flag=false;
            echo'Error en transaccion partido_apuesta';
        }
    }
    if($flag){
        //$enl->commit();
        return true;
    }else{
        //$enl->rollBack();
        return false;
    }
}



function fechahoraPartido($enl,$id){
    if($sql=$enl->prepare("SELECT horario FROM partidos WHERE idpartido=?;")){
        $sql->bind_param('s',$id);
        $sql->execute();
    $sql->bind_result($hour);
    $hora=0;
    if($sql->fetch()){
        $hora=$hour;
    }
    return $hora;
}}
function listAsesores($enl){
    $sql= "SELECT NOMBRE,SALDO,cc,APELLIDO,punto FROM asesores WHERE(administrador=0 AND cc NOT LIKE 'retiro-%' );";
    $ase = array();
    $result = $enl->query($sql)or die('error al consulta DB');
    $i=0;
    //0,0 nombre 0,1 saldo
    while($row=$result->fetch_assoc()){
        $l=0;
        $ase[$i][$l] = $row['NOMBRE']." ".$row['APELLIDO'];
        $l++;
        $ase[$i][$l] = $row['SALDO'];
        $l++;
        $ase[$i][$l] = $row['cc'];
        $l++;
        $ase[$i][$l] = $row['punto'];
        $i++;
    }
    return $ase;
}
//actualizar cuotas
function actualizarcuotas($enl,$idp,$cuota1,$cuota2,$cuotax){
    if($sql=$enl->prepare("UPDATE partidos SET cuota1=?, cuota2=?, cuotax=? WHERE idpartido=?")){
        $sql->bind_param('ssss',$cuota1,$cuota2,$cuotax,$idp);
    if($sql->execute()){
        return true;
    }else{
        return false;
    }
}}
//las siguiente 3 funciones retornan informacion de apuesta
function apuestass($enl,$ida){
    if($sql= $enl->prepare("SELECT DISTINCT idapuesta,valor,id_asesor,fecha FROM apuestas WHERE(idapuesta=?);")){
        $sql->bind_param('s',$ida);
        $sql->execute();
    $ase = array();
    $sql->bind_result($idap,$vlra,$idas,$fechaApu);
    $i=0;
    while($sql->fetch()){
        $l=0;
        $ase[$l] = $idap;
        $l++;
        $ase[$l] = $vlra;
         $l++;
        $ase[$l] = $idas;
         $l++;
        $ase[$l] = $fechaApu;
        $i++;
    }
    return $ase;
}}
function idpartidosApostados($enl,$ida){
    if($sql = $enl->prepare("select id_partido,apuesta,cuota from partido_apuesta where id_apuesta=?")){
        $sql->bind_param('s',$ida);
        $sql->execute();
        $res = array();
        $sql->bind_result($idpartido,$apuesta,$cuotaA);
        $i=0;
        while($sql->fetch()){
            $l=0;
            $res[$i][$l] = $idpartido;
            $l++;
            $res[$i][$l] = $apuesta;
            $l++;
            $res[$i][$l] = $cuotaA;
            $i++;
        }
        return $res;
    }
}
function nompunto($enl,$ida){
    if($sql = $enl->prepare("select punto from asesores where cc=?")){
        $sql->bind_param('s',$ida);
        $sql->execute();
        $sql->bind_result($punto);
        while($sql->fetch()){
            $res=$punto;
        }
        return $res;
    }
}

//retorna nombre de usuario
function asesor($enl,$id){
    if($sql=$enl->prepare("SELECT usuario FROM asesores WHERE cc=?;")){
        $sql->bind_param('s',$id);
        $sql->execute();
    $sql->bind_result($user);
    $ase='';
    //0,0 nombre 0,1 saldo
    while($sql->fetch()){
        $ase = $user;
    }
    return $ase;
}}
//sin preparar
function acfecha($enl,$idu){
    if($sql= $enl->prepare("SELECT  fechaA, fechaB, ID FROM fecha WHERE(ID=?);")){
        $sql->bind_param('s',$idu);
        $sql->execute();
    
    $sql->bind_result($a,$b,$idfe);
    $i=0;
    $ase = array();
    
        $ase[0]=NULL;
        $ase[1]=NULL;
        $ase[2]=0;
    while($sql->fetch()){
        $ase[0] = $a;
        $ase[1] = $b;
        $ase[2] = $idfe;
        
    }
    return $ase;
}}


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

function listapuesta($enl,$fecha1,$fecha2){
    if($sql=$enl->prepare("SELECT idapuesta,valor,id_asesor,fecha FROM apuestas WHERE(FECHA>=? AND FECHA<=?);")){
        $sql->bind_param('ss',$fecha1,$fecha2);
        $sql->execute();
    $sql->bind_result($idapu,$vlrapu,$idase,$fecha);
    $i=0;
    $ase = array();
    while($sql->fetch()){
        $ase[$i][0] = $idapu;//id
        $ase[$i][1] = $vlrapu;//valor
        $ase[$i][2] = $idase;//asesor
        $ase[$i][3] = $fecha;//fecha
        $i++;
        
    }
    return $ase;
}}

function idligadepartido($enl,$idpartido){
    $sql="select LIGA from partidos where ID=".$idpartido.";";
    $result = $enl->query($sql)or die("Error al consultar DB liga de partido ");
    $res="";
    while($row=$result->fetch_assoc()){
        $res=$row['LIGA'];
    }
    return $res;
}
//retorna listado de paises
function paises($enl){
    $sql = "select DISTINCT pais from ligas;";
    $result = $enl->query($sql)or die('Error al consutar DB pais de liga');
    $res='';
    $i=0;
    while($row=$result->fetch_assoc()){
        $res[$i]=$row['pais'];
        $i++;
    }
    return $res;
}
function verificarequipo($nom,$id,$enlace){
    if($sql=$enlace->prepare("select idequipo from equipo where nombre=? and id_liga=?;")){
        $sql->bind_param('si',$nom,$id);
        $sql->execute();
        $sql->bind_result($idequipo);
        while($sql->fetch()){
            return true;
            exit();
        }
        return false;
    }
}
function verificarliga($nom,$pais,$enlace){
    if($sql=$enlace->prepare("select idliga from ligas where nombre=? and pais=?;")){
        $sql->bind_param('si',$nom,$pais);
        $sql->execute();
        $sql->bind_result($idliga);
        while($sql->fetch()){
            return true;
            exit();
        }
        return false;
    }
}
function eliminarasesor($enl,$id,$idmod,$pasw,$saldo,$user){
    if($sql=$enl->prepare("update asesores set cc=?, contrasena=?, saldo=?, usuario=? where cc=?")){
        $sql->bind_param('sssss',$idmod,$pasw,$saldo,$user,$id);
        $sql->execute();
    }
}
function resultadopartido($enlace,$idpart){
    $sql = "select resultado from partidos where idpartido='".$idpart."';";
    $result = $enlace->query($sql)or die('error al consultar db');
    $res = 'false';
    while($row=$result->fetch_assoc()){
        $res=$row['resultado'];
    }
    return $res;
}
?>
