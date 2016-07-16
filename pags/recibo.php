<?php
require_once('../fpdf/fpdf.php');
require_once('gestionDB.php');
require_once('validaciones.php');
    session_start();
    $idusuario=$_SESSION['id'];
    $user = $_SESSION['usuario'];
    $idapuesta= limpiarcadenas($_POST['idapuesta']);
    
    
     class PDF extends FPDF{
        
}
    
    
    $enlace = connectionDB();
    $datos = apuestass($enlace,$idapuesta);//informacion general de apuesta
    $partidos = idpartidosApostados($enlace,$idapuesta);//partidos de apuesta
    $punto = nompunto($enlace,$idusuario);
    connectionClose($enlace);
    $cuota = 1;
    $valora;
    $fecha='';
    for($i=0;$i<count($datos);$i++){
        
        $valora = $datos[1];//valor apostado
        $idasesor = $datos[2];//valor idasesor
        $fecha = $datos[3];//valor fecha apuesta
    }
    
    
    
    $pdf = new PDF('P','pt','A4');
    $pdf->AddPage();
    
            $pdf->SetMargins(5,10,5);
            $pdf->image('../images/pdf.gif',250,15,100);
            $pdf->SetFont('Times', '', 25);
            $pdf->cell(20);
            $pdf->ln();
            $pdf->ln(10);
            $pdf->cell(0,80,'Apuesta N : '.$idapuesta,0);
            $pdf->ln(25);
    
    $pdf-> ln(30);
    date_default_timezone_set('America/Bogota');
    
    $fecha = new datetime($fecha);
    $fecha=$fecha->format('d-m-Y');
    $pdf->Cell(0,25,'Fecha De Apuesta:    '.$fecha,0);
    $pdf->ln(28);
    $pdf->Cell(0,25,'Punto:    '.$punto,0);
    $pdf->ln();
    //$pdf->SetFont('Times', 'U', 15);//subrayado
   
    $pdf->SetFont('Times', '', 28);
    $enlace=connectionDB();
    $neventos=0;
    for($i=0;$i<count($partidos);$i++){
        //$Npart=nompartido($enlace,$partido[$i][0]);
        
        $apos = $partidos[$i][1];//apuesta 1,2,x
        $par = equiposLigaPartido($enlace,$partidos[$i][0]);//retorna info de partido
        $equia= nomEquipo($par[0],$enlace);
        $equib= nomEquipo($par[1],$enlace);
        $Npart = $equia.' vs '.$equib;
        $Npart = utf8_decode($Npart);
        $fechapartido = $par[4];
        if($apos=='1'){
            //$apos=$par[0];
            $apos=utf8_decode($equia);
        }elseif($apos=='2'){
            //$apos=$par[1];
            $apos=utf8_decode($equib);
        }else{$apos='EMPATE';}
        $pdf->ln();
        $pdf->Cell(0,25,$Npart,0);
        $pdf->ln();
        $pdf->cell(0,25,$fechapartido);
        $pdf->ln();
        $pdf->Cell(240,25,$apos);
        $pdf->Cell(50,25,$partidos[$i][2]);
        $pdf->ln(20);
        $neventos++;
        $cuota*=$partidos[$i][2];
    }
    $valP=$valora*$cuota;
    $valP = number_format($valP,2,",",".");
    $valora = number_format($valora, 2, ",", ".");
 $pdf->ln();
    $pdf->cell(0,25,'Eventos seleccionados: '.$neventos); 
  
    $pdf->ln();
    $pdf->SetFont('Times', '', 25);
    //$pdf->Cell(150,15,'Punto De Apuesta:          '.$idusuario);
    $pdf->ln();
    $pdf->Cell(150,25,'Total Cuota:',0);
    $pdf->cell(200,25,round($cuota,2));
    $pdf->ln();
    $pdf->Cell(250,25,'Valor Apostado $:',0);
    $pdf->Cell(200,25,$valora,0);
    $pdf->ln();
    $pdf->Cell(250,25,'Valor A Pagar $:',0);
    $pdf->Cell(200,25,$valP,0);
    $pdf->ln(20);
    connectionClose($enlace);
    
    $pdf->SetFont('Arial','I',18);
             $pdf->ln(30);
            $pdf->MultiCell(0,18,utf8_decode('Los eventos que después de iniciados sean cancelados por cualquier razón, ya sea por orden público, climático, o cualquier otro motivo, nos acogeremos a la decisión de la terna arbitral para la definición de cualquier tipo de apuesta.'),0,'C',false);
            
            $pdf->MultiCell(0,18,utf8_decode('Los eventos aplazados serán considerados nulos a menos que sean reprogramados para ser jugados en un plazo no mayor a 24 horas con respecto al horario inicial del evento. En tales circunstancias donde un evento o eventos estén incluidos en una apuesta múltiple, la apuesta será definida en función del resto de eventos incluidos en la apuesta.'),0,'C',false);
            
            $pdf->MultiCell(0,18,utf8_decode('Cuando una apuesta se de por anulada se le reintegrara el monto apostado por el apostador.'),0,'C',false);
            
            $pdf->MultiCell(0,18,utf8_decode('Revise su ticket antes de salir del establecimiento, después no se aceptara reclamos.'),0,'C',false);
    
    $pdf->Output();
  
?>