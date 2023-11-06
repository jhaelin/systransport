<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelCliente; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfCliente extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE CLIENTES'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function clientePdf($request){
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
        $this->SetY($y);$this->SetX(10);$this->MultiCell(8, $tam, utf8_decode('Nro.'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(18);$this->MultiCell(20, $tam, utf8_decode('NIT'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(38);$this->MultiCell(35, $tam, utf8_decode('Razón Social'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(73);$this->MultiCell(17, 4, utf8_decode('No. Autorización'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(90);$this->MultiCell(38, $tam, utf8_decode('Nombre de Representante'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(128);$this->MultiCell(15, $tam, utf8_decode('Carnet'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(143);$this->MultiCell(40, $tam, utf8_decode('Dirección Empresa'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(183);$this->MultiCell(50, $tam, utf8_decode('Email'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(233);$this->MultiCell(15, $tam, utf8_decode('Fax'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(248);$this->MultiCell(20, 4, utf8_decode('Teléfono /Celular'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['cliente'];
        if($val=='TODO'){
           $data=ModelCliente::cliente(); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 6);
            $this->SetWidths(array(8, 20, 35, 17, 38, 15, 40, 50, 15,20));
            $this->SetAligns(array('C','C','C','C', 'J','J', 'J','J', 'C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nit),
                            utf8_decode($value->razon_social),
                            utf8_decode($value->nro_autorizacion),
                            utf8_decode($value->nombre_representante),
                            utf8_decode($value->ci_representante.' '.$value->expedido_representante),
                            utf8_decode($value->ciudad_cli.' z:'.$value->zona_cli.' c:'.$value->calle_cli.' n°:'.$value->numero_cli),
                            utf8_decode($value->email_cli),
                            utf8_decode($value->fax_cli),
                            utf8_decode($value->telefono_cli.' / '.$value->celular_cli)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }else{
           $data=ModelCliente::reporteCliente($val); 

           $this->SetDrawColor(0, 0, 0);
           $this->SetTextColor(0, 0, 0);  
           foreach ($data as $value){
            $this->SetFont('Arial', '', 6);
            $this->SetWidths(array(8, 20, 35, 17, 38, 15, 40, 50, 15,20));
            $this->SetAligns(array('C','C','C','C', 'J','J', 'J','J', 'C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nit),
                            utf8_decode($value->razon_social),
                            utf8_decode($value->nro_autorizacion),
                            utf8_decode($value->nombre_representante),
                            utf8_decode($value->ci_representante),
                            utf8_decode($value->ciudad_cli.' z:'.$value->zona_cli.' c:'.$value->calle_cli.' n°:'.$value->numero_cli),
                            utf8_decode($value->email_cli),
                            utf8_decode($value->fax_cli),
                            utf8_decode($value->telefono_cli.' / '.$value->celular_cli)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Clientes_'.$val; 
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