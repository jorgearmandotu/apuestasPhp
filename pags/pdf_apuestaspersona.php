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
               $fpdf->Cell(50,10,'Id Apuesta',1);
               $fpdf->Cell(40,10,'Vlr Apostado',1);
               $fpdf->Cell(40,10,'Eventos',1);
               $fpdf->Cell(40,10,'Fecha',1);
               $fpdf->Cell(50,10,'Ganancia',1);
               $fpdf->Cell(50,10,'Estado',1);
        $fechaA = limpiarcadenas($_GET['fecha1']);
        $fechaB = limpiarcadenas($_GET['fecha2']);
            
               $enlace = connectionDB();
               $apuestas = listapuestasAsesor($enlace,$idusuario,$fechaA,$fechaB);
               for($l=0;$l<count($apuestas);$l++){
                   //$l,1=idapuesta, $l,2=valor, $l3=fechaapuesta
                    $idapuesta = $apuestas[$l][0];
                    $valorpuesta = $apuestas[$l][1];
                    $fechaapuesta = $apuestas[$l][2];
                   $fechaapuesta= new datetime($fechaapuesta);
                   $fechaapuesta = $fechaapuesta->format('Y-m-d');
                   $datosapuesta = idpartidosApostados($enlace,$idapuesta);
                    $cuotat = 1;$estado='determinar';
                   for($k=0;$k<count($datosapuesta);$k++){
                        $cuotat*=$datosapuesta[$k][2];
                        $resultado = resultadopartido($enlace,$datosapuesta[$k][0]);
                        $cantidadeventos = count($datosapuesta);
                        
                        if($resultado!=''){
                            if($resultado!=$datosapuesta[$k][1] and $estado!='Por Determinar'){
                                $estado='perdio';
                            }else{
                                if($estado!='perdio' and $estado!='Por Determinar'){
                                    $estado='gano';
                                }
                            }
                        }else{
                            $estado='Por Determinar'; 
                        }
                           
                    }
                   $Pgananacia=$cuotat*$valorpuesta;
                   $fpdf->ln();
                   $fpdf->Cell(50,10,$idapuesta,1);
               $fpdf->Cell(40,10,$valorpuesta,1);
               $fpdf->Cell(40,10,$cantidadeventos,1);
               $fpdf->Cell(40,10,$fechaapuesta,1);
               $fpdf->Cell(50,10,$Pgananacia,1);
               $fpdf->Cell(50,10,$estado,1);
               }
            connectionClose($enlace);   
            $fpdf->Output();
           
           ?>