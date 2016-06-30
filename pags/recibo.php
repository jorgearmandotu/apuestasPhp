<?php
        require_once('../fpdf/fpdf.php');
        require_once('gestionDB.php');
        session_start();
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];
      
        $fpdf = new FPDF();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 16);
        $fpdf-> image('../images/pdf.gif',130,10,40);
        $fpdf->Cell(18,10,'',0);
        $fpdf->SetFont('Arial','',12); 
        $fpdf->Cell(10,10,'FECHA DE APUESTA:    '.date('d-m-Y'),0);
        
        $fpdf->Ln(30);
        $fpdf->SetFont('Arial','',12);
        $fpdf->Cell(1,10,'Numero de referencia:',1);
        $fpdf->Cell(1,30,'Total Couta:',1);
        $fpdf->Cell(1,50,'Valor apostado:',1);
        $fpdf->Cell(1,70,'Valor a pagar:',1);
        $fpdf->Cell(1,90,'Equipos Apostados:',1);
        $apostado=0.0;
        $enlace = connectionDB();
        $fecha = acfecha($enlace,$idusuario);
        $apuesta=idapuesta($enlace,$fecha[0],$fecha[1]);
        $pagar = $cuota*$apuesta[$i][1];
               $apostado = $apuesta[$i][1]+$apostado;
           $fpdf->Ln();
               $fpdf->Cell(50,10,$apuesta[$i][0],1);
               $fpdf->Cell(40,10,$cuota,1);
               $fpdf->Cell(40,10,$apuesta[$i][1],1);
               $persona = asesor($enlace,$apuesta[$i][2]);
               $fpdf->Cell(40,10,$persona[0],1);
               
               $fpdf->Cell(50,10,$pagar,1);
        
            
       
         
        
             
               

               
           

                
            $fpdf->Output();
           connectionClose($enlace);
           ?>