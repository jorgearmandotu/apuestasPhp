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
        $fpdf->Cell(10,10,'Mis apuestas ganadas y perdidas');
               $fpdf->Ln(20);
                $enlace = connectionDB();
                $personaa=tpersona($enlace);
                for($j=0;$j<count($personaa);$j++) {
                    if($personaa[$j][1]==$idusuario){
                        $fpdf->Ln(20);
                $fpdf->SetFont('Arial','B',12,8);
                $fpdf->Cell(50,10,'Punto de control '.$personaa[$j][0]);
                $fpdf->Ln();
               $fpdf->SetFont('Arial','B',10,8);
               $fpdf->Cell(50,10,'Numero referencia',1);
               $fpdf->Cell(40,10,'Cuota',1);
               $fpdf->Cell(40,10,'Valor apostado',1);
               $fpdf->Cell(40,10,'Asesor',1);
               $fpdf->Cell(50,10,'Valor a  pagar',1);
               
               
           
            $apostado=0.0;
            $ganadot=0.0;
            $ganado=0.0;
                    
           $fecha = acfecha($enlace,$idusuario);
          $apuesta=idapuesta($enlace,$fecha[0],$fecha[1]);
           for($i=0;$i<count($apuesta);$i++) {
               
               $cuota = 1.0;
               $band = 0;
               $bandd = 0;
               $apuesta1=apuestass($enlace,$apuesta[$i][0]);
               $bandp = NULL;
               for($k=0;$k<count($apuesta1);$k++) {
                   $cuota=$apuesta1[$k][1]*$cuota;
                   $partido=equiposLigaPartido($enlace,$apuesta1[$k][4]);
                   $bandp=$apuesta1[$k][3];
                   if($apuesta1[$k][5]!=$partido[4] and $apuesta1[$k][3]==$personaa[$j][1]){
                      $band=1;
                       if($partido[4]==NULL){$bandd=2;}
                   }
                   
               }
               $pagar = $cuota*$apuesta[$i][1];
               
               
               if($band==0 and $bandp==$personaa[$j][1]){
                   $apostado = $apuesta[$i][1]+$apostado;
                   $ganadot = $pagar+$ganadot;
                   $ganado = $pagar+$ganado;
                   $fpdf->Ln();
                   $fpdf->SetFillColor(0,128,0);
                   $fpdf->Cell(50,10,$apuesta[$i][0],1,0,'L',True);
                   $fpdf->Cell(40,10,$cuota,1,0,'L',True);
                   $fpdf->Cell(40,10,$apuesta[$i][1],1,0,'L',True);
                   $persona = asesor($enlace,$apuesta[$i][2]);
                   $fpdf->Cell(40,10,$persona[0],1,0,'L',True);

                   $fpdf->Cell(50,10,$pagar,1,0,'L',True);
               
               }
               
               if($band==1 and $bandp==$personaa[$j][1] and $bandd==0){
                   $apostado = $apuesta[$i][1]+$apostado;
                   $ganadot = $pagar+$ganadot;
                   
                   $fpdf->Ln();
                   $fpdf->SetFillColor(255,0,0);
                   $fpdf->Cell(50,10,$apuesta[$i][0],1,0,'L',True);
                   $fpdf->Cell(40,10,$cuota,1,0,'L',True);
                   $fpdf->Cell(40,10,$apuesta[$i][1],1,0,'L',True);
                   $persona = asesor($enlace,$apuesta[$i][2]);
                   $fpdf->Cell(40,10,$persona[0],1,0,'L',True);

                   $fpdf->Cell(50,10,$pagar,1,0,'L',True);
               }
               
           }
                    $fpdf->Ln();
                    $fpdf->SetFont('Arial','B',12);
                    $fpdf->Cell(80,10,'Valor total apostado: '.$apostado);
                    $fpdf->Cell(80,10,'Valor a pagar total: '.$ganadot);
                    $fpdf->Cell(80,10,'Valor a pagar ganado: '.$ganado);
                    
                    }
                }
            $fpdf->Output();
           connectionClose($enlace);
           ?>