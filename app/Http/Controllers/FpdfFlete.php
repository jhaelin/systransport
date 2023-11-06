<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request;
use App\ModelAdminFleteCamion; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfFlete extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE FLETE DE CAMIONES'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function fletePdf($request){
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
        $this->SetY($y);$this->SetX(18);$this->MultiCell(30, $tam, utf8_decode('Camión'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(48);$this->MultiCell(40, $tam, utf8_decode('Conductor'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(88);$this->MultiCell(40, $tam, utf8_decode('Cliente'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(128);$this->MultiCell(50, $tam, utf8_decode('Ruta'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(178);$this->MultiCell(55, $tam, utf8_decode('Descripción'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(233);$this->MultiCell(15, $tam, utf8_decode('Fecha'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(248);$this->MultiCell(20, $tam, utf8_decode('Estado'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val='';$val1='';$val2='';
        if($get!=''){

                    $val=$get['f1'];$val1=$get['f2'];$val2=$get['estado'];
                    if($val=='TODO'&&$val1=='TODO'&&$val2=='TODO'){
                       $data=ModelAdminFleteCamion::flete();  
                       foreach ($data as $value){
                        $fec=$value->fecha_flete;$fec=date("d/m/Y",strtotime($fec));
                        $this->SetFont('Arial', '', 6);
                        $this->SetWidths(array(8, 30, 40, 40, 50, 55, 15,20));
                        $this->SetAligns(array('C','J','J','J', 'J','J', 'C', 'J'));
                        $this->Row(array(utf8_decode($numero),
                                        utf8_decode($value->matricula.' '.$value->marca.' '.$value->modelo),
                                        utf8_decode($value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con),
                                        utf8_decode($value->nit.' '.$value->razon_social),
                                        utf8_decode($value->nombre_ruta.', km:'.$value->distancia_km),
                                        utf8_decode($value->descripcion_flete),
                                        utf8_decode($fec),
                                        utf8_decode($value->estado_flete)
                                        ));
                            $this->Ln(0);
                            $numero=$numero+1;
                       }
                    }elseif($val=='TODO'&& $val1=='TODO' && $val2!='TODO'){
                        //var_dump($get);exit();
                       $data=ModelAdminFleteCamion::reporteFlete1($val2); 
                       foreach ($data as $value){
                        $fec=$value->fecha_flete;$fec=date("d/m/Y",strtotime($fec));
                        $this->SetFont('Arial', '', 6);
                        $this->SetWidths(array(8, 30, 40, 40, 50, 55, 15,20));
                        $this->SetAligns(array('C','J','J','J', 'J','J', 'C', 'J'));
                        $this->Row(array(utf8_decode($numero),
                                        utf8_decode($value->matricula.' '.$value->marca.' '.$value->modelo),
                                        utf8_decode($value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con),
                                        utf8_decode($value->nit.' '.$value->razon_social),
                                        utf8_decode($value->nombre_ruta.', km:'.$value->distancia_km),
                                        utf8_decode($value->descripcion_flete),
                                        utf8_decode($fec),
                                        utf8_decode($value->estado_flete)
                                        ));
                            $this->Ln(0);
                            $numero=$numero+1;
                       }
                    }elseif($val!='TODO'&& $val1!='TODO'&& $val2=='TODO'){
                       $data=ModelAdminFleteCamion::reporteFlete2($val,$val1);
                       foreach ($data as $value){
                        $fec=$value->fecha_flete;$fec=date("d/m/Y",strtotime($fec));
                        $this->SetFont('Arial', '', 6);
                        $this->SetWidths(array(8, 30, 40, 40, 50, 55, 15,20));
                        $this->SetAligns(array('C','J','J','J', 'J','J', 'C', 'J'));
                        $this->Row(array(utf8_decode($numero),
                                        utf8_decode($value->matricula.' '.$value->marca.' '.$value->modelo),
                                        utf8_decode($value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con),
                                        utf8_decode($value->nit.' '.$value->razon_social),
                                        utf8_decode($value->nombre_ruta.', km:'.$value->distancia_km),
                                        utf8_decode($value->descripcion_flete),
                                        utf8_decode($fec),
                                        utf8_decode($value->estado_flete)
                                        ));
                            $this->Ln(0);
                            $numero=$numero+1;
                       }
                    }elseif($val!='TODO'&& $val1!=''&& $val2!='TODO'){
                       $data=ModelAdminFleteCamion::reporteFlete3($val,$val1,$val2);  
                       foreach ($data as $value){
                        $fec=$value->fecha_flete;$fec=date("d/m/Y",strtotime($fec));
                        $this->SetFont('Arial', '', 6);
                        $this->SetWidths(array(8, 30, 40, 40, 50, 55, 15,20));
                        $this->SetAligns(array('C','J','J','J', 'J','J', 'C', 'J'));
                        $this->Row(array(utf8_decode($numero),
                                        utf8_decode($value->matricula.' '.$value->marca.' '.$value->modelo),
                                        utf8_decode($value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con),
                                        utf8_decode($value->nit.' '.$value->razon_social),
                                        utf8_decode($value->nombre_ruta.', km:'.$value->distancia_km),
                                        utf8_decode($value->descripcion_flete),
                                        utf8_decode($fec),
                                        utf8_decode($value->estado_flete)
                                        ));
                            $this->Ln(0);
                            $numero=$numero+1;
                       } 
                    }else{}
        }else{}

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Flete_Camiones_'.$val; 
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
