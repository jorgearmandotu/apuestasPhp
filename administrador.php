<?php
    include 'salir.php';
    if ($_SESSION['tipo']!='ADMINISTRADOR') { 
        header('location: index2.html');
    }
?>
<h1>Binenbenidos administtradores</h1>