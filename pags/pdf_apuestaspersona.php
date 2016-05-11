<?php
        require_once('../fpdf/fpdf.php');
        require_once('gestionDB.php');
        session_start();
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];

        $fpdf = new FPDF('L');
        $fpdf-> AddPage();
        $fpdf->SetFont('Arial','B',22); 
        $fpdf-> image('../images/pdf.gif',240,10,40);
        $fpdf->Cell(260,10,'BOOKIESPORT',0,0,'C');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',18); 
        $fpdf->Cell(10,10,'Todas mis apuestas');
               $fpdf->Ln(20);
               $fpdf->SetFont('Arial','B',10,8);
               $fpdf->Cell(50,10,'Nombre Apostador',1);
               $fpdf->Cell(40,10,'CC',1);
               $fpdf->Cell(40,10,'Valor',1);
               $fpdf->Cell(40,10,'Asesor',1);
               $fpdf->Cell(50,10,'Partido',1);
               $fpdf->Cell(40,10,'Equipo',1);
               
           $enlace = connectionDB();
           $fecha = acfecha($enlace);
           $apuesta=apuestass($enlace,$fecha[0],$fecha[1]);
           for($i=0;$i<count($apuesta);$i++) {
               if($apuesta[$i][3]==$idusuario){
           $fpdf->Ln();
               $fpdf->Cell(50,10,$apuesta[$i][0],1);
               $fpdf->Cell(40,10,$apuesta[$i][1],1);
               $fpdf->Cell(40,10,$apuesta[$i][2],1);
               $persona = asesor($enlace,$apuesta[$i][3]);
               $fpdf->Cell(40,10,$persona[0],1);
               $partido=equiposLigaPartido($enlace,$apuesta[$i][4]);
               $fpdf->Cell(50,10,$partido[0].' VS '.$partido[1],1);
               if($apuesta[$i][5]=='1'){
               $fpdf->Cell(40,10,$partido[0],1);}
               
               if($apuesta[$i][5]=='2'){
               $fpdf->Cell(40,10,$partido[1],1);}
               if($apuesta[$i][5]=='X'){
               $fpdf->Cell(40,10,'EMPATE',1);}
               }
               
           }
               
            $fpdf->Output();
           connectionClose($enlace);
           ?>