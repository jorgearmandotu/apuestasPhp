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
        $fpdf->Cell(10,10,'Apuestas ganadas por punto');
               
                $fpdf->SetFont('Arial','B',10);
$enlace = connectionDB();
$asesores = listAsesores($enlace);
               for($i=0;$i<count($asesores);$i++){
                   $fpdf->Ln(20);
                   $fpdf->SetFont('Arial','B',10);
                   $fpdf->Cell(100,10,'Asesor: '.$asesores[$i][4],1);
                   $fpdf->Cell(100,10,'punto: '.$asesores[$i][3],1);
                   $fpdf->ln();
               $fpdf->Cell(65,10,'Id Apuesta',1);
               $fpdf->Cell(30,10,'Vlr Apostado',1);
               $fpdf->Cell(25,10,'Eventos',1);
               $fpdf->Cell(25,10,'Fecha',1);
               $fpdf->Cell(30,10,'Ganancia',1);
               $fpdf->Cell(25,10,'Estado',1);
               $fpdf->SetFont('Times','',10);
                   
                   $idAsesor=$asesores[$i][2];
                   $apuestas = listapuestasAsesor($enlace,$idAsesor,$fechaA,$fechaB);
                   for($l=0;$l<count($apuestas);$l++){
                       //$l,1=idapuesta, $l,2=valor, $l3=fechaapuesta
                       $idapuesta = $apuestas[$l][0];
                       $valorpuesta = $apuestas[$l][1];
                       $fechaapuesta = $apuestas[$l][2];
                       $fechaapuesta= new datetime($fechaapuesta);
                        $fechaapuesta = $fechaapuesta->format('Y-m-d');
                       $datosapuesta = idpartidosApostados($enlace,$idapuesta);
                       $cuotat = 1;
                       $terminado = false;
                       $estado='';
                       
                       for($k=0;$k<count($datosapuesta);$k++){
                           $cuotat*=$datosapuesta[$k][2];
                           $resultado = resultadopartido($enlace,$datosapuesta[$k][0]);
                           $cantidadeventos = count($datosapuesta);
                           
                           if($resultado!=''){
                                if($resultado!=$datosapuesta[$k][1] and $estado!='Por Determinar'){
                                    $estado='perdio';
                                    $terminado = true;
                                }else{
                                    if($estado!='perdio' and $estado!='Por Determinar'){
                                        $estado='gano';
                                        $terminado = true;
                                    }
                                }
                            }else{
                                $estado='Por Determinar'; 
                               $terminado=false;
                            }
                           
                       }
                       $Pgananacia=$cuotat*$valorpuesta;
                       if($terminado){
                           $fpdf->ln();
                           $fpdf->Cell(65,10,$idapuesta,1);
                            $fpdf->Cell(30,10,$valorpuesta,1);
                            $fpdf->Cell(25,10,$cantidadeventos,1);
                            $fpdf->Cell(25,10,$fechaapuesta,1);
                            $fpdf->Cell(30,10,$Pgananacia,1);
                            $fpdf->Cell(25,10,$estado,1);
                       }
                   }
                       
               }
               connectionClose($enlace);
            $fpdf->Output();
           
           ?>