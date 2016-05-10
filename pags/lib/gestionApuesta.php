<?php

$id=$_POST['id'];
$cuota=$_POST['cuota'];

    if($a==null){
    $a[0][0]=$id;
    $a[0][1]=$cuota;
}else{
//   recorrer arreglo y agrgar datos al final 
}

header('location: ../apuesta.php');

?>