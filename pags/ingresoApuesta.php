<?php


require_once('gestionDB.php');


//funcion para ingresar una apuesta
function ingresarPartido(){
    
}
function ingresarEquipo(){
    
}
function buscarLiga($liga){
    
}

function ingresarApuesta(){
    $nombreA=strip_tags($_POST['nombre']);
    $cedulaA=strip_tags($_POST['cedula']);
    $valorA=strip_tags($_POST['valor']);
    $fechaPartido = strip_tags($_POST['fecha']);
    $ligaP = strip_tags($_POST['liga']);
    $partido = strip_tags($_POST['nombre']);
    $equipoA = strip_tags($_POST['equipoA']);
    $equipoB = strip_tags($_POST['equipoB']);
    $horaP = strip_tags($_POST['hora']);
    $equipoApostado = strip_tags($_POST["cedula"]);
    
    //validar y agregar partido
    if($partido = 'seleccion'){
        ingresarPartido($equipoA,$equipoB,$horaP,$ligaP);
    }
    //verificar liga si no ingresarla
    buscarLiga($ligaP);
    echo("datos");
    echo('nombre: '.$nombreA.'<br>'.
     ' cedula: '.$cedulaA.'<br>'.
    ' valor: '.$valorA.'<br>'.
    ' fechaP: '.$fechaPartido.'<br>'.
    'liga: '.$ligaP.'<br>'.
    'partido: '.$partido.'<br>'.
    'equipoA: '.$equipoA.'<br>'.
    'equipoB: '.$equipoB.'<br>'.
    '$hora: '.$horaP.'<br>'.
    'equipo apostado: '.$equipoApostado);
}

ingresarApuesta();

?>