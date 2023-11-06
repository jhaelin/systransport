<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelEgreso; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfEgreso extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE EGRESOS ECONÓMICOS'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function egresoPdf($request){
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
        $cantidad=0; $costo_unidad=0;$costo_total=0;
        $tam=7;$rec=0;$y=35;$fondo=true;
        $this->SetY($y);$this->SetX(10);$this->MultiCell(10, $tam, utf8_decode('N°.'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(20);$this->MultiCell(22, $tam, utf8_decode('N° Factura'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(42);$this->MultiCell(60, $tam, utf8_decode('Concepto Pago'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(102);$this->MultiCell(30, $tam, utf8_decode('Cantidad'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(132);$this->MultiCell(30, $tam, utf8_decode('Costo Unidad'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(162);$this->MultiCell(30, $tam, utf8_decode('Costo Total'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(192);$this->MultiCell(60, $tam, utf8_decode('Observaciones'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(252);$this->MultiCell(17, $tam, utf8_decode('Fecha'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['f1']; $val1=$get['f2'];
        if($val=='TODO'){
           $data=ModelEgreso::egreso(); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(10, 22, 60, 30, 30, 30, 60, 17));
            $this->SetAligns(array('C','C','J','C', 'R','R', 'J', 'C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nro_factura),
                            utf8_decode($value->concepto_pago),
                            utf8_decode($value->cantidad),
                            utf8_decode($value->costo_unidad),
                            utf8_decode($value->costo_total),
                            utf8_decode($value->observacion),
                            utf8_decode($value->fecha_e)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
                $cantidad=$cantidad+$value->cantidad; 
                $costo_unidad=$costo_unidad+$value->costo_unidad;
                $costo_total=$costo_total+$value->costo_total;
           }
            $this->SetFont('Arial', 'B', 7);
            $this->SetWidths(array(92,  30, 30, 30, 77));
            $this->SetAligns(array('R', 'R','R','R', 'L'));
            $this->Row(array(utf8_decode('TOTAL'),
                            utf8_decode($cantidad),
                            utf8_decode($costo_unidad),
                            utf8_decode($costo_total),
                            utf8_decode('BOLIVIANOS')
                            ));
        }else{
           $data=ModelEgreso::reporteEgreso($val,$val1); 

           $this->SetDrawColor(0, 0, 0);
           $this->SetTextColor(0, 0, 0);  
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(10, 22, 60, 30, 30, 30, 60, 17));
            $this->SetAligns(array('C','C','J','C', 'R','R', 'J', 'C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nro_factura),
                            utf8_decode($value->concepto_pago),
                            utf8_decode($value->cantidad),
                            utf8_decode($value->costo_unidad),
                            utf8_decode($value->costo_total),
                            utf8_decode($value->observacion),
                            utf8_decode($value->fecha_e)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
                $cantidad=$cantidad+$value->cantidad; 
                $costo_unidad=$costo_unidad+$value->costo_unidad;
                $costo_total=$costo_total+$value->costo_total;
           }
            $this->SetFont('Arial', 'B', 7);
            $this->SetWidths(array(92,  30, 30, 30,    77));
            $this->SetAligns(array('R', 'R','R','R', 'L'));
            $this->Row(array(utf8_decode('TOTAL'),
                            utf8_decode($cantidad),
                            utf8_decode($costo_unidad),
                            utf8_decode($costo_total),
                            utf8_decode('BOLIVIANOS')
                            ));
            
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Egresos_Economicos_'.$val; 
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