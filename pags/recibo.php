<?php
require_once('../fpdf/fpdf.php');
require_once('gestionDB.php');
require_once('validaciones.php');
    session_start();
    $idusuario=$_SESSION['id'];
    $user = $_SESSION['usuario'];
    $idapuesta= limpiarcadenas($_POST['idapuesta']);
    

    
    class PDF extends FPDF{
        function header(){
            $idapuesta= limpiarcadenas($_POST['idapuesta']);
            $this->SetMargins(40,60);
            $this->image('../images/pdf.gif',250,18,100);
            $this->SetFont('Times', '', 12);
            $this->cell(80);
            $this->ln();
            $this->ln(10);
            $this->cell(0,50,'Apuesta N : '.$idapuesta);
            $this->ln(20);
        }
        function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-100);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
             
    $this->Cell(0,10,'Los eventos que despues sean cancelados por cualquier motivo
ya sea por orden publico seran decididos por decicion arbitaria.',0,0,'C');
            $this-> ln(0);
    $this->Cell(0,40,'Los eventos aplazados seran considerados nulos a menos que sean 
reprogranados para jugarse dentro de las sigueintes 24 horas.',0,0,'C');
            $this-> ln(0);
    $this->Cell(0,70,'No se pueden realizar apuestas a menos de 5 minutos de iniciarse 
un evento.',0,0,'C');
}
}
    
    
    $enlace = connectionDB();
    $datos = apuestass($enlace,$idapuesta);
    connectionClose($enlace);
    $partido = array();
    $cuota = 1;
    $valora;
    for($i=0;$i<count($datos);$i++){
        $partido[$i][0] = $datos[$i][4];//idpartido
        $cuota = $cuota*floatval($datos[$i][1]);
        $valora = $datos[$i][2];
        $partido[$i][1] = $datos[$i][5];//apuesta 1 x 2
        $partido[$i][2]=$datos[$i][1];//cuota equipo apostado
    }
    $valP=$valora*$cuota;
    $valP = number_format($valP,2,",",".");
    $valora = number_format($valora, 2, ",", ".");
    
    $pdf = new PDF('P','pt','A4');
    $pdf->AddPage();
    $pdf-> ln(20);
    date_default_timezone_set('America/Bogota');
    $pdf->Cell(0,12,'Fecha De Apuesta:    '.date('d-m-Y'),0);
    $pdf->ln();
    $pdf->Cell(0,12,'Punto De Apuesta:   '.$idusuario);
    $pdf->ln();
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(100,12,'Total Cuota:',0);
    $pdf->cell(200,12,round($cuota,2));
    $pdf->ln();
    $pdf->Cell(100,12,'Valor Apostado $:',0);
    $pdf->Cell(200,12,$valora,0);
    $pdf->ln();
    $pdf->Cell(100,12,'Valor A Pagar $:',0);
    $pdf->Cell(200,12,$valP,0);
    $pdf->ln(20);
    $pdf->SetFont('Times', 'U', 12);
    $pdf->Cell(200,12,'Partido',0);
    $pdf->Cell(150,12,'Apuesta',0);
    $pdf->Cell(50,12,'Cuotas',0);
    $pdf->SetFont('Times', '', 9);
    $enlace=connectionDB();
    $neventos=0;
    for($i=0;$i<count($partido);$i++){
        //$Npart=nompartido($enlace,$partido[$i][0]);
        $apos = $partido[$i][1];
        $par = equiposLigaPartido($enlace,$partido[$i][0]);
        $Npart = $par[0].' vs '.$par[1];
        $Npart = utf8_decode($Npart);
        $fechapartido = $par[5].' '.$par[3];
        if($apos=='1'){
            $apos=$par[0];
            $apos=utf8_decode($apos);
        }elseif($apos=='2'){
            $apos=$par[1];
            $apos=utf8_decode($apos);
        }else{$apos='EMPATE';}
        $pdf->ln();
        $pdf->Cell(200,12,$Npart);
        $pdf->ln();
        $pdf->cell(0,12,$fechapartido);
        $pdf->ln();
        $pdf->Cell(150,12,$apos);
        $pdf->Cell(50,12,$partido[$i][2]);
        $pdf->ln(20);
        $neventos++;
    }
 $pdf->ln();
    $pdf->cell(0,12,'Eventos seleccionados: '.$neventos);
       
    connectionClose($enlace);

    
    $pdf->Output();

  
?>