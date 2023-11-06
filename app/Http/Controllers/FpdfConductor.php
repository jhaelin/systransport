<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelConductor; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfConductor extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE CONDUCTORES'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function conductorPdf($request){
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
        $this->SetY($y);$this->SetX(20);$this->MultiCell(32, $tam, utf8_decode('Nombres'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(52);$this->MultiCell(30, $tam, utf8_decode('Ap. Paterno'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(82);$this->MultiCell(30, $tam, utf8_decode('Ap. Materno'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(112);$this->MultiCell(25, $tam, utf8_decode('Carnet'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(137);$this->MultiCell(20, 4, utf8_decode('Categoria Licencia'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(157);$this->MultiCell(60, $tam, utf8_decode('Dirección'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(217);$this->MultiCell(30, $tam, utf8_decode('Teléfono/Celular'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(247);$this->MultiCell(20, $tam, utf8_decode('Fecha'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['conductor'];
        if($val=='TODO'){
           $data=ModelConductor::conductor(); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(10, 32, 30, 30, 25, 20, 60, 30, 20));
            $this->SetAligns(array('C','J','J','J', 'J','C', 'J','J', 'J')); 
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nombre_con),
                            utf8_decode($value->paterno_con),
                            utf8_decode($value->materno_con),
                            utf8_decode($value->ci_con.' '.$value->expedido_con),
                            utf8_decode($value->categoria_licencia),
                            utf8_decode($value->direccion_con),
                            utf8_decode($value->telefono_con.' / '.$value->celular_con),
                            utf8_decode('')
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }else{
           $data=ModelConductor::reporteConductor($val); 

           $this->SetDrawColor(0, 0, 0);
           $this->SetTextColor(0, 0, 0);  
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(10, 32, 30, 30, 25, 20, 60, 30, 20));
            $this->SetAligns(array('C','J','J','J', 'J','C', 'J','J', 'J'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nombre_con),
                            utf8_decode($value->paterno_con),
                            utf8_decode($value->materno_con),
                            utf8_decode($value->ci_con.' '.$value->expedido_con),
                            utf8_decode($value->categoria_licencia),
                            utf8_decode($value->direccion_con),
                            utf8_decode($value->telefono_con.' / '.$value->celular_con),
                            utf8_decode('')
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Conductores_'.$val; 
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