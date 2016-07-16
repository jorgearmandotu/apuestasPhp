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
        $fpdf->Cell(10,10,'Apuestas Totales');
               $fpdf->Ln(20);
               $fpdf->SetFont('Arial','B',10);
               $fpdf->Cell(65,10,'Numero de referencia',1);
               $fpdf->Cell(18,10,'Eventos',1);
               $fpdf->Cell(67,10,'Asesor',1);
               $fpdf->Cell(24,10,'Fecha',1);
               $fpdf->Cell(32,10,'Apuesta',1);
               $fpdf->Cell(36,10,'Ganancia',1);
               $fpdf->Cell(35,10,'Estado',1);
               $fpdf->SetFont('Times','',10);

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
                   $Pgananacia=$cuotat*$valor;
                   $fpdf->ln();
                   $fpdf->cell(65,10,$idapuesta,1);
                   $fpdf->cell(18,10,$cantPartidos,1);
                   $fpdf->cell(67,10,$asesor,1);
                   $fpdf->cell(24,10,$fecha,1);
                   $fpdf->cell(32,10,$valor,1);
                   $fpdf->cell(36,10,$Pgananacia,1);
                   $fpdf->cell(35,10,$estado,1);
               }
               connectionClose($enlace);
            $fpdf->Output();
           
           ?>