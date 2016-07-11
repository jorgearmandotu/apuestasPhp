<?php
require_once '../gestionDB.php';
require_once('../validaciones.php');
              validarAsesor();

$fecha = strip_tags($_POST['fecha']);
if(isset($_POST['liga'])){//filtra
    $liga = limpiarcadenas($_POST['liga']);

$enlace = connectionDB();
    if($liga!='Todas'){
        //$liga = idliga($liga,$enlace);
$partidos = partidoslig($enlace,$fecha,$liga);
        
    }else{
        $partidos = partidos($enlace,$fecha);
    }

 $res="";

for($i=0;$i<count($partidos)-1;$i++){
    $idP=$partidos[$i][0];
    $nomEquiA=$partidos[$i][1];
    $nomEquiA = nomEquipo($nomEquiA,$enlace);
    $nomEquiB=$partidos[$i][2];
    $nomEquiB = nomEquipo($nomEquiB,$enlace);
    //$nomLiga=$partidos[$i][3];
    $hora=$partidos[$i][3];
    $local=$partidos[$i][4];
    $empate=$partidos[$i][5];
    $visitante=$partidos[$i][6];
    //$nomLiga = nomLiga($nomLiga,$enlace);
    if(isset($partidos[$i][7])){
        $idliga = $partidos[$i][7];
    }
    
        
//    la siguiente cadena crea los botones y el formulario q se reenvia a la misma paguina en viando los datos cuando se ha seleccionado halgo el botn apostar y los inputs con la id del partido y el valor de la cuota seleccionada no deben ser visibles se hace con css
        $res.="<div class='fila'>
        
        <div class='celda9'>
         <label>".$hora." </label>
        </div>
        <div class='celda6'>
        <input type='checkbox' class='cuotas' value='".$local."%".$idP."%1' name='cuota[]' id='".$idP."'>
            
				<label for='".$idP."'>".$nomEquiA."  ".$local."</label></input>
       
       </div>
       <div class='celda7'>
            <input type='checkbox' class='cuotas' value='".$empate."%".$idP."%X' name='cuota[]' id='".$idP."a'>
            <label for='".$idP."a'>Empate  ".$empate."</label></input>
        </div>
        
        <div class='celda8'>
        <input type='checkbox' class='cuotas' value='".$visitante."%".$idP."%2'  name='cuota[]' id='".$idP."b'>
        <label for='".$idP."b'>".$nomEquiB."  ".$visitante."</label></input>
        
        </div>
        
        
              </div>";
}
connectionClose($enlace);
}else{//carga todo
   $enlace = connectionDB();
$partidos = partidos($enlace,$fecha);
 $res="";

for($i=0;$i<count($partidos);$i++){
    $idP=$partidos[$i][0];
    $nomEquiA=$partidos[$i][1];
    $nomEquiA = nomEquipo($nomEquiA,$enlace);
    $nomEquiB=$partidos[$i][2];
    $nomEquiB = nomEquipo($nomEquiB,$enlace);
    //$nomLiga=$partidos[$i][3];
    $hora=$partidos[$i][3];
    $local=$partidos[$i][4];
    $empate=$partidos[$i][5];
    $visitante=$partidos[$i][6];
    //$nomLiga = nomLiga($nomLiga,$enlace);
    
        
//    la siguiente cadena crea los botones y el formulario q se reenvia a la misma paguina en viando los datos cuando se ha seleccionado halgo el botn apostar y los inputs con la id del partido y el valor de la cuota seleccionada no deben ser visibles se hace con css
        $res.="<div class='fila'>
        
        <div class='celda9'>
         <label>".$hora." </label>
        </div>
        <div class='celda6'>
        <input type='checkbox' class='cuotas' value='".$local."%".$idP."%1' name='cuota[]' id='".$idP."'>
            
				<label for='".$idP."'>".$nomEquiA."  ".$local."</label></input>
       
       </div>
       <div class='celda7'>
            <input type='checkbox' class='cuotas' value='".$empate."%".$idP."%X' name='cuota[]' id='".$idP."a'>
            <label for='".$idP."a'>Empate  ".$empate."</label></input>
        </div>
        
        <div class='celda8'>
        <input type='checkbox' class='cuotas' value='".$visitante."%".$idP."%2'  name='cuota[]' id='".$idP."b'>
        <label for='".$idP."b'>".$nomEquiB."  ".$visitante."</label></input>
        
        </div>
        
        
              </div>";
}
connectionClose($enlace);
}

echo $res;

?>