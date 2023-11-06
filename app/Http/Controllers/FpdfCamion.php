<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelCamion; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfCamion extends FPDF{ 

    public function __construct(){
        parent::__construct(); 
    }

    function Header(){
        $this->SetY(6);
        $e=ModelEmpresa::emp();
        $this->Image('uploads_files/'.$e->logo, 10, 7, 30, 15);
        $this->Ln(15);
        $this->SetTextColor(0, 0, 0);
        $this->SetY(15);$this->SetX(90);
        $this->SetFont('Arial', '', 10);
        $tam=6;$rec=0;
        $this->Cell(90, $tam, utf8_decode($e->nombre_empresa), 0, 1, 'C');
        $this->Ln(1);
        $this->SetTextColor(21, 21, 21);
        $this->SetFont('Arial', '', 10);
        $tam=6;$rec=0;
        $this->SetY(21);$this->SetX(90);
        $this->Cell(90, $tam, utf8_decode('REPORTE DE CAMIONES'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function camionPdf($request){
        $this->SetTopMargin(10);
        $this->SetLeftMargin(10);
        $this->SetRightMargin(10);
        $this->SetAutoPageBreak(1, 30);
        $this->AddPage('L', 'letter');
        $this->AliasNbPages();
        $this->Ln(0);
        $this->SetFillColor(188, 203, 214);
        $this->SetTextColor(0, 0, 0);////////TEXT
        $this->SetDrawColor(68, 73, 73);
        $this->SetLineWidth(0);
        $this->SetFont('Arial', 'B', 7);
        $tam=8;$rec=0;$y=35;$fondo=true;
        $this->SetY($y);$this->SetX(10);$this->MultiCell(10, $tam, utf8_decode('Nro.'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(20);$this->MultiCell(30, $tam, utf8_decode('Matrícula'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(50);$this->MultiCell(40, $tam, utf8_decode('Marca'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(90);$this->MultiCell(40, $tam, utf8_decode('Modelo'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(130);$this->MultiCell(72, $tam, utf8_decode('Descripción'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(202);$this->MultiCell(40, $tam, utf8_decode('Tipo de Vehículo'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(242);$this->MultiCell(25, $tam, utf8_decode('Fecha Registro'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['camion'];
        if($val=='TODO'){
           $data=ModelCamion::camion(); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(10, 30, 40, 40, 72, 40, 25));
            $this->SetAligns(array('C','C','C','C', 'J','J', 'C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->matricula),
                            utf8_decode($value->marca),
                            utf8_decode($value->modelo),
                            utf8_decode($value->descripcion_cam),
                            utf8_decode($value->tipo_vehiculo),
                            utf8_decode($value->fecha_registro)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }else{
           $data=ModelCamion::reporteCamion($val); 

           $this->SetDrawColor(0, 0, 0);
           $this->SetTextColor(0, 0, 0);  
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(10, 30, 40, 40, 72, 40, 25));
            $this->SetAligns(array('C','C','C','C', 'J','J', 'C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->matricula),
                            utf8_decode($value->marca),
                            utf8_decode($value->modelo),
                            utf8_decode($value->descripcion_cam),
                            utf8_decode($value->tipo_vehiculo),
                            utf8_decode($value->fecha_registro)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Camiones_'.$val; 
        $nombre='Reporte '.$id.' .pdf';          
        $this->Output($nombre, 'I');
        exit;
    }

    function Footer(){
     $this->SetY(-20);
     $this->SetFont('Arial','',8);
     $this->Cell(270,10,$this->PageNo(),0,0,'C');

    }
}