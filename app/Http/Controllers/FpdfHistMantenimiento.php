<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelMantenimientoCamion; 
use App\ModelCamion; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfHistMantenimiento extends FPDF{ 
 
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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE HISTORIA DE MANTENIMIENTO DE CAMIONES'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function histmantenimientoPdf($request){
        $this->SetTopMargin(10);
        $this->SetLeftMargin(10);
        $this->SetRightMargin(10);
        $this->SetAutoPageBreak(1, 30);
        $this->AddPage('L', 'letter');
        $this->AliasNbPages();
        $this->Ln(20);
        $numero=1;
        $get=$request->all();
        $val=$get['idcamion'];
        //echo $val;
        if($val!=''){
           $cam=ModelCamion::edit($val);
           //var_dump($cam);exit();
           $data=ModelMantenimientoCamion::repHisManjq($val);
           $this->SetFillColor(188, 203, 214);  
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           $this->SetFont('Arial', 'B', 7);

           $tam=8;$rec=0;$y=35;$fondo=true; $z=0; $z1=0; $z2=0; $z3=0; $z4=0;
           $this->SetY($y);$this->SetX(10);$this->MultiCell(60, $tam, utf8_decode('Matricula'),1 ,'C', $fondo);
           $this->SetFillColor(255, 255, 255);
           $this->SetY($y);$this->SetX(70);$this->MultiCell(100, $tam, utf8_decode($cam->matricula),1 ,'C', $fondo);
           $this->Ln(0);
           $z=$y+$tam;
           $this->SetFillColor(188, 203, 214);
           $this->SetY($z);$this->SetX(10);$this->MultiCell(60, $tam, utf8_decode('Modelo'),1 ,'C', $fondo);
           $this->SetFillColor(255, 255, 255);
           $this->SetY($z);$this->SetX(70);$this->MultiCell(100, $tam, utf8_decode($cam->modelo),1 ,'C', $fondo);
           $z1=$z+$tam;
           $this->SetFillColor(188, 203, 214);
           $this->SetY($z1);$this->SetX(10);$this->MultiCell(60, $tam, utf8_decode('Marca'),1 ,'C', $fondo);
           $this->SetFillColor(255, 255, 255);
           $this->SetY($z1);$this->SetX(70);$this->MultiCell(100, $tam, utf8_decode($cam->marca),1 ,'C', $fondo);
           $z2=$z1+$tam;
           $this->SetFillColor(188, 203, 214);
           $this->SetY($z2);$this->SetX(10);$this->MultiCell(60, $tam, utf8_decode('Tipo Vehículo'),1 ,'C', $fondo);
           $this->SetFillColor(255, 255, 255);
           $this->SetY($z2);$this->SetX(70);$this->MultiCell(100, $tam, utf8_decode($cam->tipo_vehiculo),1 ,'C', $fondo);
           $z3=$z2+$tam;
           $this->SetFillColor(188, 203, 214);
           $this->SetY($z3);$this->SetX(10);$this->MultiCell(60, $tam, utf8_decode('Descripción'),1 ,'C', $fondo);
           $this->SetFillColor(255, 255, 255);
           $this->SetY($z3);$this->SetX(70);$this->MultiCell(100, $tam, utf8_decode($cam->descripcion_cam),1 ,'C', $fondo);
           $z4=$z3+20;

           //$this->SetY($y);$this->SetX(242);$this->MultiCell(25, $tam, utf8_decode('foto'),1 ,'C', $fondo);

           $this->Image('uploads_files/'.$cam->foto_cam, 171, 35, 98, 31);
           
           $this->SetFillColor(188, 203, 214);
           $this->SetY($z3);$this->SetX(170);$this->MultiCell(55, $tam, utf8_decode('Fecha Registro'),1 ,'C', $fondo);
           $this->SetFillColor(255, 255, 255);
           $this->SetY($z3);$this->SetX(225);$this->MultiCell(44, $tam, utf8_decode($cam->fecha_registro),1 ,'C', $fondo);
           $this->Ln(5);
            $this->Cell(250, $tam, utf8_decode('DETALLE DE MANTENIMIENTO'), 0, 1, 'C');
            $this->Ln(5);

            $this->SetFillColor(188, 203, 214);
            $this->SetTextColor(0, 0, 0);////////TEXT
            $this->SetDrawColor(68, 73, 73);
            $this->SetLineWidth(0);
            $this->SetFont('Arial', 'B', 7);
            $tam=8;$rec=0;$y=$z4;$fondo=true;
            $this->SetY($y);$this->SetX(10);$this->MultiCell(10, $tam, utf8_decode('Nro.'),1 ,'C', $fondo);
            $this->SetY($y);$this->SetX(20);$this->MultiCell(70, $tam, utf8_decode('Mantenimiento'),1 ,'C', $fondo);
            $this->SetY($y);$this->SetX(90);$this->MultiCell(99, $tam, utf8_decode('Observaciones'),1 ,'C', $fondo);
            $this->SetY($y);$this->SetX(189);$this->MultiCell(40, $tam, utf8_decode('Fecha Registro'),1 ,'C', $fondo);
            $this->SetY($y);$this->SetX(229);$this->MultiCell(40, $tam, utf8_decode('Fecha Próxima Revisión'),1 ,'C', $fondo);
            $this->Ln(0);

           foreach ($data as $value){

            if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                $this->SetFont('Arial', '', 7);
                $this->SetWidths(array(10, 70, 99, 40, 40));
                $this->SetAligns(array('C','J','J','C', 'C'));
                $this->Row10(array(utf8_decode($numero),
                                utf8_decode($value->mantenimiento),
                                utf8_decode($value->observacion),
                                utf8_decode($value->fecha_man),
                                utf8_decode($value->fecha_prox_revision),
                                ));
                    $this->Ln(0);
                    $numero=$numero+1;
            } 
           }
        }else{

            echo "Seleccione Camión";
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);$f=date('d/m/Y');
        $id='Lista_de_Historia_Mantenimiento_Camiones_'.$cam->matricula.'('.$f.')'; 
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