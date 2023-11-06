<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelIngreso; 
use App\ModelEgreso; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php'); 

Class FpdfImpuesto extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE CÁLCULO DE IMPUESTOS'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        // $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        // $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function impuestoPdf($request){
        $this->SetTopMargin(10);
        $this->SetLeftMargin(10);
        $this->SetRightMargin(10);
        $this->SetAutoPageBreak(1, 30);
        $this->AddPage('L', 'letter');
        $this->AliasNbPages();
        $this->Ln(0);
        $get=$request->all();$tam=6;$fecMin='';$fecMax='';
        $val=$get['f1']; $val1=$get['f2'];
        if($val!='TODO'){
            $fec=date("d-m-Y",strtotime($val));
            $fec1=date("d-m-Y",strtotime($val1));
            $this->Cell(250, $tam, utf8_decode('Entre Fechas,  '.$fec.'  a  '.$fec1), 0, 1, 'C');
        }else{
            $fechaMinE=ModelEgreso::fechaMin();$fechaMaxE=ModelEgreso::fechaMax();
            $fechaMinI=ModelIngreso::fechaMin();$fechaMaxI=ModelIngreso::fechaMax();
            //var_dump($fechaMinE);exit();
            if($fechaMinE<$fechaMinI){$fecMin=$fechaMinE;}else{$fecMin=$fechaMinI;}
            if($fechaMaxE<$fechaMaxI){$fecMax=$fechaMaxE;}else{$fecMax=$fechaMaxI;}
            $fec=date("d-m-Y",strtotime($fecMin));
            $fec1=date("d-m-Y",strtotime($fecMax));
            $this->Cell(250, $tam, utf8_decode('Entre Fechas,  '.$fec.'  a  '.$fec1), 0, 1, 'C');
        }

        $this->SetFillColor(188, 203, 214);
        $this->SetTextColor(0, 0, 0);////////TEXT
        $this->SetDrawColor(68, 73, 73);
        $this->SetLineWidth(0);
        $this->SetFont('Arial', 'B', 7);
        $tam=8;$rec=0;$y=35;$fondo=true;
        $this->SetY($y);$this->SetX(10);$this->MultiCell(86, $tam, utf8_decode('MONTO TOTAL DE INGRESOS ECONÓMICOS'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(96);$this->MultiCell(86, $tam, utf8_decode(''),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(182);$this->MultiCell(86, $tam, utf8_decode('MONTO TOTAL DE EGRESOS ECONÓMICOS'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $tam=6;

        if($val=='TODO'){

           $egre=ModelEgreso::impEgreso();
           $ingr=ModelIngreso::impIngreso();
           $ing=0; $egr=0; $diferencia=0; $iva=0; $ing_iue=0; $iue=0; $impTotalPago=0; $impTotalPagar=0; $total=0;
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($ingr as $value){
            $this->SetFont('Arial', '', 7);
            $this->Cell(86, $tam, utf8_decode($value->total_ingreso), 1, 0, 'R');
            $ingr=$value->total_ingreso;
           }  

            $this->Cell(86, $tam, utf8_decode(''), 1, 0, 'C');

           foreach ($egre as $value){
            $this->SetFont('Arial', '', 7);
            $this->Cell(86, $tam, utf8_decode($value->total_egreso), 1, 1, 'R');
            $egre=$value->total_egreso;
           }                                
           $this->Ln(0);
            $diferencia= $ingr-$egre;
            //var_dump($egre, $ingr);exit();
            $iva=$diferencia*(0.13);
            $ing_iue=$ing*(0.03);
            $impTotalPago=$iva+$ing_iue;

            $iue=$diferencia*(0.25);
            $impTotalPagar=$iue;
            $total=$impTotalPago+$impTotalPagar;
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(86, $tam, utf8_decode('TOTAL PAGO IMPUESTO'), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode($impTotalPago), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode(''), 1, 1, 'C');                           
            $this->Ln(0);
            $this->Cell(86, $tam, utf8_decode('TOTAL PAGAR IUE'), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode($impTotalPagar), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode(''), 1, 0, 'C');                           
            $this->Ln(6);            
            $this->Cell(86, $tam, utf8_decode('TOTAL A PAGAR'), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode($total), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode('BOLIVIANOS'), 1, 0, 'l');

        }elseif($val!='TODO'&& $val1!=''){
           $egre=ModelEgreso::impEgreso1($val,$val1);
           $ingr=ModelIngreso::impIngreso1($val,$val1);  

           $ing=0; $egr=0; $diferencia=0; $iva=0; $ing_iue=0; $iue=0; $impTotalPago=0; $impTotalPagar=0; 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($ingr as $val){
            $this->SetFont('Arial', '', 7);
            $this->Cell(86, $tam, utf8_decode($val->total_ingreso), 1, 0, 'R');
            $ingr=$val->total_ingreso;
           }  

            $this->Cell(86, $tam, utf8_decode(''), 1, 0, 'C');

           foreach ($egre as $value){
            $this->SetFont('Arial', '', 7);
            $this->Cell(86, $tam, utf8_decode($value->total_egreso), 1, 1, 'R');
            $egre=$value->total_egreso;
           }                                
            $this->Ln(0);
            $diferencia= $ingr-$egre;
            $iva=$diferencia*(0.13);
            $ing_iue=$ing*(0.03);
            $impTotalPago=$iva+$ing_iue;

            $iue=$diferencia*(0.25);
            $impTotalPagar=$iue;
            $total=$impTotalPago+$impTotalPagar;
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(86, $tam, utf8_decode('TOTAL PAGO IMPUESTO'), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode($impTotalPago), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode(''), 1, 1, 'C');                           
            $this->Ln(0);
            $this->Cell(86, $tam, utf8_decode('TOTAL PAGAR IUE'), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode($impTotalPagar), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode(''), 1, 0, 'C');                          
            $this->Ln(6);
            $this->Cell(86, $tam, utf8_decode('TOTAL A PAGAR'), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode($total), 1, 0, 'R');
            $this->Cell(86, $tam, utf8_decode('BOLIVIANOS'), 1, 0, 'l');
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Calculo_Impuestos'; 
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