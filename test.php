<?php
require_once('pags/gestionDB.php');

$enlace = connectionDB();
$sql = 'SELECT NOMBRE FROM ligas ORDER BY NOMBRE;';
    $result = $enlace->query($sql)or die('error al consutar BD');
$arr = array();
$i =0;
while($row=$result->fetch_assoc()){
    $arr[$i]=$row['NOMBRE'];
    echo($arr[$i]);
    $i++;
}
echo('consultado');
echo($arr[3]);
?>