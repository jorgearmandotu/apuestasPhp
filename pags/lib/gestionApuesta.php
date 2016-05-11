<?php
$cuota=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $cuota=$_POST["cuota"];
    $count = count($cuota);
    for ($i = 0; $i < $count; $i++) {
//        echo $cuota[$i];
        $datos = explode(':',$cuota[$i],3);
            for($l=0;$l<count($datos);$l++){
                echo '<br>'.$datos[$l];
            }
    }
}
// la cadena q se imprime es el valor de lacuota separa por 2 puntos y sigue el id del partido dos puntos y la apuesta local L visitante V o enpate E asi 1.5:3:L que sria cuota 1.5 en partido 3
//osea q estos els lo que se debe imprimir y hacer la calculadora
    
//header('location: ..apuesta.php');

?>