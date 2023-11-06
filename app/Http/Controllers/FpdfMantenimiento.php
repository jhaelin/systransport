<?php 
namespace App\Http\Controllers;    
use Crypt;
use FPDF;
use Illuminate\Http\Request; 
use App\ModelMantenimientoCamion; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfMantenimiento extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE MANTENIMIENTO DE CAMIONES'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function mantenimientoPdf($request){
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
        $this->SetFont('Arial', 'B', 6);
        $tam=8;$rec=0;$y=35;$fondo=true;
        $this->SetY($y);$this->SetX(10);$this->MultiCell(10, $tam, utf8_decode('N°'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(20);$this->MultiCell(25, $tam, utf8_decode('Matrícula'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(45);$this->MultiCell(25, $tam, utf8_decode('Modelo'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(70);$this->MultiCell(30, $tam, utf8_decode('Marca'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(100);$this->MultiCell(30, $tam, utf8_decode('Tipo de Vehículo'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(130);$this->MultiCell(50, $tam, utf8_decode('Mantenimiento'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(180);$this->MultiCell(50, $tam, utf8_decode('Observaciones'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(230);$this->MultiCell(20, $tam, utf8_decode('Fecha Registro'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(250);$this->MultiCell(20, 4, utf8_decode('Fecha de Próxima'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['f1'];$val1=$get['f2']; $val2=$get['idcamion'];
        //var_dump($val, $val1,$val2);
        if($val=='TODO'&&  $val1=='TODO'&& $val2=='TODO'){
           $data=ModelMantenimientoCamion::repManjq();  
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                $this->SetFont('Arial', '', 7);
                $this->SetWidths(array(10, 25, 25,   30, 30, 50,   50,20, 20));
                $this->SetAligns(array('C','C','C',  'C', 'J','J',  'J','C','C'));
                $this->Row(array(utf8_decode($numero),
                                utf8_decode($value->matricula),
                                utf8_decode($value->modelo),

                                utf8_decode($value->marca),
                                utf8_decode($value->tipo_vehiculo),
                                utf8_decode($value->mantenimiento),

                                utf8_decode($value->observacion),
                                utf8_decode($value->fecha_man),
                                utf8_decode($value->fecha_prox_revision),
                                ));
                    $this->Ln(0);
                    $numero=$numero+1;
            }
           }
        }elseif($val=='TODO' && $val1=='TODO' && $val2!='TODO'){
           $data=ModelMantenimientoCamion::repManjq1($val2);  
            
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                $this->SetFont('Arial', '', 7);
                $this->SetWidths(array(10, 25, 25,   30, 30, 50,   50,20, 20));
                $this->SetAligns(array('C','C','C',  'C', 'J','J',  'J','C','C'));
                $this->Row(array(utf8_decode($numero),
                                utf8_decode($value->matricula),
                                utf8_decode($value->modelo),

                                utf8_decode($value->marca),
                                utf8_decode($value->tipo_vehiculo),
                                utf8_decode($value->mantenimiento),

                                utf8_decode($value->observacion),
                                utf8_decode($value->fecha_man),
                                utf8_decode($value->fecha_prox_revision),
                                ));
                    $this->Ln(0);
                    $numero=$numero+1;
            }
           }

        }elseif($val!='TODO' && $val1!='' && $val2=='TODO'){
           $data=ModelMantenimientoCamion::repManjq2($val,$val1);  
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                $this->SetFont('Arial', '', 7);
                $this->SetWidths(array(10, 25, 25,   30, 30, 50,   50,20, 20));
                $this->SetAligns(array('C','C','C',  'C', 'J','J',  'J','C','C'));
                $this->Row(array(utf8_decode($numero),
                                utf8_decode($value->matricula),
                                utf8_decode($value->modelo),

                                utf8_decode($value->marca),
                                utf8_decode($value->tipo_vehiculo),
                                utf8_decode($value->mantenimiento),

                                utf8_decode($value->observacion),
                                utf8_decode($value->fecha_man),
                                utf8_decode($value->fecha_prox_revision),
                                ));
                    $this->Ln(0);
                    $numero=$numero+1;
            }
           }
        }elseif($val!='TODO' && $val1!='' && $val2!='TODO'){
           $data=ModelMantenimientoCamion::repManjq3($val,$val1,$val2);  
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                $this->SetFont('Arial', '', 7);
                $this->SetWidths(array(10, 25, 25,   30, 30, 50,   50,20, 20));
                $this->SetAligns(array('C','C','C',  'C', 'J','J',  'J','C','C'));
                $this->Row(array(utf8_decode($numero),
                                utf8_decode($value->matricula),
                                utf8_decode($value->modelo),

                                utf8_decode($value->marca),
                                utf8_decode($value->tipo_vehiculo),
                                utf8_decode($value->mantenimiento),

                                utf8_decode($value->observacion),
                                utf8_decode($value->fecha_man),
                                utf8_decode($value->fecha_prox_revision),
                                ));
                    $this->Ln(0);
                    $numero=$numero+1;
            }
           }
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Mantenimiento_Camiones'; 
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