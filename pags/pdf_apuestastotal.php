 <?php
        require_once('../fpdf/fpdf.php');
        require_once('gestionDB.php');
        require_once('validaciones.php');
        session_start();
        $idusuario=$_SESSION['id'];
        $user = $_SESSION['usuario'];

$fechaA = limpiarcadenas($_GET['fecha1']);
$fechaB = limpiarcadenas($_GET['fecha2']);
        $fpdf = new FPDF('L');
        $fpdf-> AddPage();
        $fpdf->SetFont('Arial','B',22); 
        $fpdf-> image('../images/pdf.gif',240,10,40);
        $fpdf->Cell(260,10,'BOOKIESPORT',0,0,'C');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',18); 
        $fpdf->Cell(10,10,'Apuestas Totales de BOOKIESPORT');
               $fpdf->Ln(20);
               $fpdf->SetFont('Arial','B',10,8);
               $fpdf->Cell(50,10,'Numero de referencia',1);
               $fpdf->Cell(40,10,'Eventos',1);
               $fpdf->Cell(40,10,'Asesor',1);
               $fpdf->Cell(40,10,'Fecha',1);
               $fpdf->Cell(50,10,'Apuesta',1);
               $fpdf->Cell(50,10,'Ganancia Potencial',1);
               $fpdf->Cell(50,10,'Estado',1);
               //$fpdf->Cell(50,10,$fechaA,1);
               //$fpdf->Cell(50,10,$fechaB,1);

        $enlace = connectionDB();
               $apuestas = listapuesta($enlace,$fechaA,$fechaB);
               for($i=0;$i<count($apuestas);$i++){
                   //i,0=idapuesta, i.1=valor, i,2=idasesor, i,3=fecha apuesta
                   $idapuesta=$apuestas[$i][0];
                   $idasesor=$apuestas[$i][2];
                   $asesor = asesor($enlace,$idasesor);
                   $fecha = $apuestas[$i][3];
                   $fecha= new datetime($fecha);
                   $fecha = $fecha->format('Y-m-d');
                   $valor = $apuestas[$i][1];
                   $datosapuesta = idpartidosApostados($enlace,$idapuesta);
                   $cantPartidos = count($datosapuesta);
                   $cuotat=1;
                   $estado='determinar';
                   $estado;
                   for($l=0;$l<count($datosapuesta);$l++){
                        //l,0=idpartido, l,1=apuesta, l,2=cuota
                       $cuotat*=$datosapuesta[$l][2];
                       $resultado = resultadopartido($enlace,$datosapuesta[$l][0]);
                       if($resultado!=''){
                           if($resultado!=$datosapuesta[$l][1] and $estado!='Por Determinar'){
                               $estado='<label class="perdio">perdio</label>';
                           }else{
                               if($estado!='<label class="perdio">perdio</label>' and $estado!='Por Determinar'){
                                   $estado='<label class="gano">gano</label>';
                               }
                           }
                       }else{
                         $estado='Por Determinar';  
                       }
                   }
                   $Pgananacia=$cuotat*$valor;
                   $fpdf->ln();
                   $fpdf->cell(0,10,$idapuesta,1);
                  /* <td class="celdas">'.$idapuesta.'</td>
                   <td class="celdas">'.$cantPartidos.'</td>
                   <td class="celdas">'.$asesor.'</td>
                   <td class="celdas">'.$fecha.'</td>
                   <td class="celdas">'.$valor.'</td>
                   <td class="celdas">'.$Pgananacia.'</td>
                   <td class="celdas">'.$estado.'</td>';
               }
               
                '</table>';
               
           /*$apostado = 0.0;   
           $enlace = connectionDB();
           $fecha = acfecha($enlace,$idusuario);
           $apuesta=idapuesta($enlace,$fecha[0],$fecha[1]);
           for($i=0;$i<count($apuesta);$i++) {
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
                $fpdf->Ln();  
                $fpdf->SetFont('Arial','B',11,8);
               $fpdf->Cell(50,10,'Total apostado '.$apostado,0);*/
               
            $fpdf->Output();
           //connectionClose($enlace);
           ?>