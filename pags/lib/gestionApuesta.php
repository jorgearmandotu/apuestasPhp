<?php
$cuota=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $cuota=$_POST["cuota"];
    $count = count($cuota);
    $cuotatotal=1;
    for ($i = 0; $i < $count; $i++) {
//        echo $cuota[$i];
        $datos = explode(':',$cuota[$i],3);
            echo "<ul>
          <li><label>partido: ".$datos[1]."</label>
        <li>
            <span>apuesta: ".$datos[2]."</span>
            <span id=cuotaspan''>cuota: ".$datos[0]."</span>
        </li>
         
          </ul>";
        $cuotatotal=$cuotatotal*floatval($datos[0]);
    }
    echo 'cuotatotal: '.$cuotatotal;
  /*  <form method='post' action'' id='formapstar'>
          <ul>
          <li><label>partido</label>
              <input type='hidden' value=''></li>
        <li>
            <span>apuesta: </span>
            <span id=cuotaspan''>cuota</span>
        </li>
         
          </ul>
          </form>*/
}
// la cadena q se imprime es el valor de lacuota separa por 2 puntos y sigue el id del partido dos puntos y la apuesta local L visitante V o enpate E asi 1.5:3:L que sria cuota 1.5 en partido 3
//osea q estos els lo que se debe imprimir y hacer la calculadora
    
//header('location: ..apuesta.php');

?>