<?php
           require_once('../fpdf/fpdf.php');
        require_once('gestionDB.php');

        $fpdf = new FPDF('L');
        $fpdf-> AddPage();
        $fpdf->SetFont('Arial','B',22); 
        $fpdf-> image('../images/pdf.gif',240,10,40);
        $fpdf->Cell(260,10,'BOOKIESPORT',0,0,'C');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',18); 
        $fpdf->Cell(10,10,'Apuestas ganadas por cada punto');
               $fpdf->Ln(20);
                $enlace = connectionDB();
                $personaa=tpersona($enlace);
                for($j=0;$j<count($personaa);$j++) {
                    $fpdf->Ln(20);
                $fpdf->SetFont('Arial','B',12,8);
                $fpdf->Cell(50,10,'Punto de control '.$personaa[$j][0]);
                $fpdf->Ln();
               $fpdf->SetFont('Arial','B',10,8);
               $fpdf->Cell(50,10,'Nombre Apostador',1);
               $fpdf->Cell(40,10,'CC',1);
               $fpdf->Cell(40,10,'Valor',1);
               $fpdf->Cell(40,10,'Asesor',1);
               $fpdf->Cell(50,10,'Partido',1);
               $fpdf->Cell(40,10,'Equipo',1);
               
           
           $fecha = acfecha($enlace);
           $apuesta=apuestass($enlace,$fecha[0],$fecha[1]);
           for($i=0;$i<count($apuesta);$i++) {
               $partido=equiposLigaPartido($enlace,$apuesta[$i][4]);
               if($apuesta[$i][5]==$partido[4] and $apuesta[$i][3]==$personaa[$j][1]){
               $fpdf->Ln();
               $fpdf->SetFillColor(255,0,0);
               $fpdf->Cell(50,10,$apuesta[$i][0],1,0,'L',True);
               $fpdf->Cell(40,10,$apuesta[$i][1],1,0,'L',True);
               $fpdf->Cell(40,10,$apuesta[$i][2],1,0,'L',True);
               $persona = asesor($enlace,$apuesta[$i][3]);
               $fpdf->Cell(40,10,$persona[0],1,0,'L',True);
               
               $fpdf->Cell(50,10,$partido[0].' VS '.$partido[1],1,0,'L',True);
               if($apuesta[$i][5]=='1'){
               $fpdf->Cell(40,10,$partido[0],1,0,'L',True);}
               
               if($apuesta[$i][5]=='2'){
               $fpdf->Cell(40,10,$partido[1],1,0,'L',True);}
               if($apuesta[$i][5]=='X'){
               $fpdf->Cell(40,10,'EMPATE',1,0,'L',True);}
               }
               
               if($apuesta[$i][5]!=$partido[4] and $apuesta[$i][3]==$personaa[$j][1] and $partido[4]!=NULL){
               $fpdf->Ln();
               $fpdf->SetFillColor(0,128,0);
               $fpdf->Cell(50,10,$apuesta[$i][0],1,0,'L',True);
               $fpdf->Cell(40,10,$apuesta[$i][1],1,0,'L',True);
               $fpdf->Cell(40,10,$apuesta[$i][2],1,0,'L',True);
               $persona = asesor($enlace,$apuesta[$i][3]);
               $fpdf->Cell(40,10,$persona[0],1,0,'L',True);
               
               $fpdf->Cell(50,10,$partido[0].' VS '.$partido[1],1,0,'L',True);
               if($apuesta[$i][5]=='1'){
               $fpdf->Cell(40,10,$partido[0],1,0,'L',True);}
               
               if($apuesta[$i][5]=='2'){
               $fpdf->Cell(40,10,$partido[1],1,0,'L',True);}
               if($apuesta[$i][5]=='X'){
               $fpdf->Cell(40,10,'EMPATE',1,0,'L',True);}
               }
               
           }
                }
            $fpdf->Output();
           connectionClose($enlace);
           ?>