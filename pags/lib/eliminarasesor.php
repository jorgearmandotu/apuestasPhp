<?php
require_once'../gestionDB.php';
require_once'../validaciones.php';
$idasesor = limpiarcadenas($_POST['asesores']);
echo($idasesor);
date_default_timezone_set('America/Bogota');
//$hora= new datetime();
$hora= date('Y-m-d_H:i:s');

$idmod='retiro-'.$idasesor.'-'.$hora;
$passw= '0';
$saldo = '0';
$enlace= connectionDB();
$usuario = asesor($enlace,$idasesor);
$usuario = 'retiro-'.$usuario.'-'.$hora;
eliminarasesor($enlace,$idasesor,$idmod,$passw,$saldo,$usuario);
header('location: ../eliminarasesores.php')
?>