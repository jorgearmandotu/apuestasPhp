<!DOCTYPE HTML>
<html lang="es">
   <head>
       <meta charset="utf-8">
       <title>asesor</title>
   </head>
    <body>
    
    <?php
        require_once('gestionDB.php');
            
        
    ?>
    <table>
       <tr>
        <th>Asesor</th>
        <th>Saldo Actual</th>
        </tr>
        <?php
        $enlace= connectionDB();
        $ase = listAsesores($enlace);
        connectionClose($enlace);
        for($i=0;$i<count($ase);$i++){
            $l=0;
            echo("<tr><td>".$ase[$i][$l]."</td>");
            $l++;
            echo("<td>".$ase[$i][$l]."</td><td><td><input type='text'><button class='saldo'>Agregar saldo</button>");
            $l++;
            echo("<label>".$ase[$i][$l]."</label></tr>");
        }
        ?>
        
    </table>
    </body>
</html>