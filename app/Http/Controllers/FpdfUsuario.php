<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelUsuario; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfUsuario extends FPDF{ 

    public function __construct(){
        parent::__construct(); 
    }

    function Header(){
        $this->SetY(6);
        $e=ModelEmpresa::emp();
        $this->Image('uploads_files/'.$e->logo, 10, 7, 30, 15);
        $this->Ln(15);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', '', 5);
        $this->SetDrawColor(255, 255, 255);
        $this->SetFillColor(255, 255, 255);
        // $this->SetWidths(array(30));
        // $this->SetAligns(array('C'));
        $this->SetY(15);$this->SetX(90);
        $this->SetFont('Arial', '', 10);
        $tam=6;$rec=0;
        //$this->Row(array(utf8_decode($e->nombre_empresa)));
        $this->Cell(90, $tam, utf8_decode($e->nombre_empresa), 0, 1, 'C');
        $this->Ln(1);
        $this->SetTextColor(21, 21, 21);
        $this->SetFont('Arial', '', 10);
        $tam=6;$rec=0;

        $this->SetY(21);$this->SetX(90);
        $this->Cell(90, $tam, utf8_decode('REPORTE DE USUARIOS'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        // $fecha=getdate();$dia=$fecha['mday'];$mes=0;
        // $anio=$fecha['year'];$hoy=$dia." / ".$mes." / ".$anio; 
        // $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        //echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        //Salida: Viernes 24 de Febrero del 2012
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function usuarioPdf($request){
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
        $tam=10;$rec=0;$y=35;$fondo=true;
        $this->SetY($y);$this->SetX(10);$this->MultiCell(8, $tam, utf8_decode('Nro.'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(18);$this->MultiCell(15, 5, utf8_decode('Código de Usuario'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(33);$this->MultiCell(30, $tam, utf8_decode('Nombre'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(63);$this->MultiCell(30, $tam, utf8_decode('Apellido Paterno'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(93);$this->MultiCell(30, $tam, utf8_decode('Apellido Materno'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(123);$this->MultiCell(62, $tam, utf8_decode('Dirección'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(185);$this->MultiCell(40, $tam, utf8_decode('Email'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(225);$this->MultiCell(23, $tam, utf8_decode('Teléfono Celular'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(248);$this->MultiCell(20, 5, utf8_decode('Tipo de Usuario'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['tipo'];
        if($val=='TODO'){
           $data=ModelUsuario::usuario(); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(8, 15, 30, 30, 30, 62, 40, 23, 20 ));
            $this->SetAligns(array('C','J','C','C', 'C','J', 'C','C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->codigo_usuario),
                            utf8_decode($value->nombre),
                            utf8_decode($value->paterno),
                            utf8_decode($value->materno),
                            utf8_decode('Z: '.$value->zona.'C/: '.$value->calle.'N°: '.$value->numero),
                            utf8_decode($value->email),
                            utf8_decode($value->telefono.' '.$value->celular),
                            utf8_decode($value->tipo_usuario)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }else{
           $data=ModelUsuario::ustipo($val); 

           $this->SetDrawColor(0, 0, 0);
           $this->SetTextColor(0, 0, 0);  
           foreach ($data as $value){
            $this->SetFont('Arial', '', 7);
            $this->SetWidths(array(8, 15, 30, 30, 30, 62, 40, 23, 20 ));
            $this->SetAligns(array('C','J','C','C', 'C','J', 'C','C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->codigo_usuario),
                            utf8_decode($value->nombre),
                            utf8_decode($value->paterno),
                            utf8_decode($value->materno),
                            utf8_decode('Z: '.$value->zona.'C/: '.$value->calle.'N°: '.$value->numero),
                            utf8_decode($value->email),
                            utf8_decode($value->telefono.' '.$value->celular),
                            utf8_decode($value->tipo_usuario)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
           }
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Usuarios_'.$val; 
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