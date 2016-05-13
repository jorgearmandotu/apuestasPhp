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
               $fpdf->Cell(50,10,'Numero de referencia',1);
               $fpdf->Cell(40,10,'Cuota',1);
               $fpdf->Cell(40,10,'Valor apostado',1);
               $fpdf->Cell(40,10,'Asesor',1);
               $fpdf->Cell(50,10,'Valor a pagar',1);
               
           $apostado = 0.0;   
           $enlace = connectionDB();
           $fecha = acfecha($enlace,$idusuario);
           $apuesta=idapuesta($enlace,$fecha[0],$fecha[1]);
           for($i=0;$i<count($apuesta);$i++) {
               if($apuesta[$i][2]==$idusuario){
           $cuota = 1.0;
               
               $apuesta1=apuestass($enlace,$apuesta[$i][0]);
               for($j=0;$j<count($apuesta1);$j++) {
                   $cuota=$apuesta1[$j][1]*$cuota;
               }
               $pagar = $cuota*$apuesta[$i][1];
               $apostado = $apuesta[$i][1]+$apostado;
           $fpdf->Ln();
               $fpdf->Cell(50,10,$apuesta[$i][0],1);
               $fpdf->Cell(40,10,$cuota,1);
               $fpdf->Cell(40,10,$apuesta[$i][1],1);
               $persona = asesor($enlace,$apuesta[$i][2]);
               $fpdf->Cell(40,10,$persona[0],1);
               
               $fpdf->Cell(50,10,$pagar,1);
               }
               
           }
            $fpdf->Ln();  
                $fpdf->SetFont('Arial','B',11,8);
               $fpdf->Cell(50,10,'Total apostado '.$apostado,0);
               
            $fpdf->Output();
           connectionClose($enlace);
           ?>