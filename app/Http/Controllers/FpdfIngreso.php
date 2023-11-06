<?php 
namespace App\Http\Controllers;   
use Crypt;
use FPDF;
use Illuminate\Http\Request; 
use App\ModelIngreso; 
use App\ModelEmpresa;
include(app_path().'/library/fpdf/Fpdf.php');

Class FpdfIngreso extends FPDF{ 

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
        $this->Cell(90, $tam, utf8_decode('REPORTE DE INGRESOS ECONÓMICAS'), 0, 1, 'C');
        $this->Ln(1);
        $this->SetFont('Arial', '', 10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->Cell(250, $tam, utf8_decode('En Fecha, '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')), 0, 1, 'C');
        $pagina=$this->PageNo();
    }

    //REPORTE FORM1 
    public function ingresoPdf($request){
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
        $tam=9;$rec=0;$y=35;$fondo=true;$cantidad=0; $costo_unidad=0;$costo_total=0;
        $this->SetY($y);$this->SetX(10);$this->MultiCell(6, $tam, utf8_decode('N°'),1 ,'C', $fondo);
        $this->SetFont('Arial', 'B', 5);
        $this->SetY($y);$this->SetX(16);$this->MultiCell(12, 4.5, utf8_decode('N° Transporte'),1 ,'C', $fondo);
        $this->SetFont('Arial', 'B', 6);
        $this->SetY($y);$this->SetX(28);$this->MultiCell(12, $tam, utf8_decode('Fecha'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(40);$this->MultiCell(13, $tam, utf8_decode('Código'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(53);$this->MultiCell(13, 4.5, utf8_decode('N° Hoja de Entrada'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(66);$this->MultiCell(13, 4.5, utf8_decode('Doc. Compra'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(79);$this->MultiCell(18, 4.5, utf8_decode('transportadora (Empresa)'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(97);$this->MultiCell(13, $tam, utf8_decode('Placa'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(110);$this->MultiCell(13, $tam, utf8_decode('N° Gasto'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(123);$this->MultiCell(13, 4.5, utf8_decode('Hoja de Trabajo'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(136);$this->MultiCell(13, $tam, utf8_decode('Cliente'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(149);$this->MultiCell(13, 4.5, utf8_decode('Tonelada (TN)'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(162);$this->MultiCell(15, 4.5, utf8_decode('Precio Unidad'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(177);$this->MultiCell(20, $tam, utf8_decode('Total Costo Flete'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(197);$this->MultiCell(20, $tam, utf8_decode('Ruta'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(217);$this->MultiCell(20, 3, utf8_decode('N° entrega, N° Material / N° Mercadería'),1 ,'J', $fondo);
        $this->SetY($y);$this->SetX(237);$this->MultiCell(20, $tam, utf8_decode('Observaciones'),1 ,'C', $fondo);
        $this->SetY($y);$this->SetX(257);$this->MultiCell(12, 4.5, utf8_decode('Fecha Registro'),1 ,'C', $fondo);
        $this->Ln(0);$numero=1;
        $get=$request->all();
        $val=$get['f1'];$val1=$get['f2']; $val2=$get['id_cliente'];
        if($val=='TODO'){
           $data=ModelIngreso::ingreso(); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 5.5);
            $this->SetWidths(array(6, 12, 12,   13, 13, 13,   18,13, 13,   13, 13, 13,   15, 20, 20,   20, 20, 12));
            $this->SetAligns(array('C','C','C',  'C', 'J','J',  'C','C','C',  'C','C','J',  'J', 'C','C',  'C','C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nro_transporte),
                            utf8_decode($value->fecha_ing),

                            utf8_decode($value->codigo_ing),
                            utf8_decode($value->nro_hoja_entrada),
                            utf8_decode($value->doc_compra),

                            utf8_decode($value->nombre_empresa),
                            utf8_decode($value->matricula),
                            utf8_decode($value->nro_gasto),

                            utf8_decode($value->hoja_trabajo),
                            utf8_decode($value->razon_social),
                            utf8_decode($value->tonelada_tn),

                            utf8_decode($value->precio_unidad),
                            utf8_decode($value->total_costo_flete),
                            utf8_decode($value->nombre_ruta),

                            utf8_decode($value->nro_entrega.', '.$value->nro_entrega),
                            utf8_decode($value->nro_material_mercaderia),
                            utf8_decode($value->fecha_registro_ing)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
                $cantidad=$cantidad+$value->tonelada_tn; 
                $costo_unidad=$costo_unidad+$value->precio_unidad;
                $costo_total=$costo_total+$value->total_costo_flete; 
           }
            $this->SetFont('Arial', 'B', 6);
            $this->SetWidths(array(139,    13,   15,   20,  20,    52));
            $this->SetAligns(array('R',    'J',  'J', 'C',  'C',  'C'));
            $this->Row(array(utf8_decode('TOTAL'),
                            utf8_decode($cantidad),
                            utf8_decode($costo_unidad),
                            utf8_decode($costo_total),
                            utf8_decode('BOLIVIANOS'),
                            utf8_decode('')
                            ));
        }elseif($val=='TODO' && $val1=='' && $val2!='TODO'){
           $data=ModelIngreso::reporteIngreso1($val2); 
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 5.5);
            $this->SetWidths(array(6, 12, 12,   13, 13, 13,   18,13, 13,   13, 13, 13,   15, 20, 20,   20, 20, 12));
            $this->SetAligns(array('C','C','C',  'C', 'J','J',  'C','C','C',  'C','C','J',  'J', 'C','C',  'C','C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nro_transporte),
                            utf8_decode($value->fecha_ing),

                            utf8_decode($value->codigo_ing),
                            utf8_decode($value->nro_hoja_entrada),
                            utf8_decode($value->doc_compra),

                            utf8_decode($value->nombre_empresa),
                            utf8_decode($value->matricula),
                            utf8_decode($value->nro_gasto),

                            utf8_decode($value->hoja_trabajo),
                            utf8_decode($value->razon_social),
                            utf8_decode($value->tonelada_tn),

                            utf8_decode($value->precio_unidad),
                            utf8_decode($value->total_costo_flete),
                            utf8_decode($value->nombre_ruta),

                            utf8_decode($value->nro_entrega.', '.$value->nro_entrega),
                            utf8_decode($value->nro_material_mercaderia),
                            utf8_decode($value->fecha_registro_ing)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
                $cantidad=$cantidad+$value->tonelada_tn; 
                $costo_unidad=$costo_unidad+$value->precio_unidad;
                $costo_total=$costo_total+$value->total_costo_flete;
           }

            $this->SetFont('Arial', 'B', 6);
            $this->SetWidths(array(139,    13,   15,   20,  20,    52));
            $this->SetAligns(array('R',    'J',  'J', 'C',  'C',  'C'));
            $this->Row(array(utf8_decode('TOTAL'),
                            utf8_decode($cantidad),
                            utf8_decode($costo_unidad),
                            utf8_decode($costo_total),
                            utf8_decode('BOLIVIANOS'),
                            utf8_decode('')
                            ));

        }elseif($val!='TODO' && $val1!='' && $val2=='TODO'){
           $data=ModelIngreso::reporteIngreso2($val,$val1);
           $this->SetDrawColor(68, 73, 73);
           $this->SetTextColor(0, 0, 0); 
           foreach ($data as $value){
            $this->SetFont('Arial', '', 5.5);
            $this->SetWidths(array(6, 12, 12,   13, 13, 13,   18,13, 13,   13, 13, 13,   15, 20, 20,   20, 20, 12));
            $this->SetAligns(array('C','C','C',  'C', 'J','J',  'C','C','C',  'C','C','J',  'J', 'C','C',  'C','C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nro_transporte),
                            utf8_decode($value->fecha_ing),

                            utf8_decode($value->codigo_ing),
                            utf8_decode($value->nro_hoja_entrada),
                            utf8_decode($value->doc_compra),

                            utf8_decode($value->nombre_empresa),
                            utf8_decode($value->matricula),
                            utf8_decode($value->nro_gasto),

                            utf8_decode($value->hoja_trabajo),
                            utf8_decode($value->razon_social),
                            utf8_decode($value->tonelada_tn),

                            utf8_decode($value->precio_unidad),
                            utf8_decode($value->total_costo_flete),
                            utf8_decode($value->nombre_ruta),

                            utf8_decode($value->nro_entrega.', '.$value->nro_entrega),
                            utf8_decode($value->nro_material_mercaderia),
                            utf8_decode($value->fecha_registro_ing)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
                $cantidad=$cantidad+$value->tonelada_tn; 
                $costo_unidad=$costo_unidad+$value->precio_unidad;
                $costo_total=$costo_total+$value->total_costo_flete;
           }
            $this->SetFont('Arial', 'B', 6);
            $this->SetWidths(array(139,    13,   15,   20,  20,    52));
            $this->SetAligns(array('R',    'J',  'J', 'C',  'C',  'C'));
            $this->Row(array(utf8_decode('TOTAL'),
                            utf8_decode($cantidad),
                            utf8_decode($costo_unidad),
                            utf8_decode($costo_total),
                            utf8_decode('BOLIVIANOS'),
                            utf8_decode('')
                            ));
        }elseif($val!='TODO' && $val1!='' && $val2!='TODO'){
           $data=ModelIngreso::reporteIngreso3($val,$val1,$val2);

           $this->SetDrawColor(0, 0, 0);
           $this->SetTextColor(0, 0, 0);  
           foreach ($data as $value){
            $this->SetFont('Arial', '', 5.5);
            $this->SetWidths(array(6, 12, 12,   13, 13, 13,   18,13, 13,   13, 13, 13,   15, 20, 20,   20, 20, 12));
            $this->SetAligns(array('C','C','C',  'C', 'J','J',  'C','C','C',  'C','C','J',  'J', 'C','C',  'C','C','C'));
            $this->Row(array(utf8_decode($numero),
                            utf8_decode($value->nro_transporte),
                            utf8_decode($value->fecha_ing),

                            utf8_decode($value->codigo_ing),
                            utf8_decode($value->nro_hoja_entrada),
                            utf8_decode($value->doc_compra),

                            utf8_decode($value->nombre_empresa),
                            utf8_decode($value->matricula),
                            utf8_decode($value->nro_gasto),

                            utf8_decode($value->hoja_trabajo),
                            utf8_decode($value->razon_social),
                            utf8_decode($value->tonelada_tn),

                            utf8_decode($value->precio_unidad),
                            utf8_decode($value->total_costo_flete),
                            utf8_decode($value->nombre_ruta),

                            utf8_decode($value->nro_entrega.', '.$value->nro_entrega),
                            utf8_decode($value->nro_material_mercaderia),
                            utf8_decode($value->fecha_registro_ing)
                            ));
                $this->Ln(0);
                $numero=$numero+1;
                $cantidad=$cantidad+$value->tonelada_tn; 
                $costo_unidad=$costo_unidad+$value->precio_unidad;
                $costo_total=$costo_total+$value->total_costo_flete;
           }
            $this->SetFont('Arial', 'B', 6);
            $this->SetWidths(array(139,    13,   15,   20,  20,    52));
            $this->SetAligns(array('R',    'J',  'J', 'C',  'C',  'C'));
            $this->Row(array(utf8_decode('TOTAL'),
                            utf8_decode($cantidad),
                            utf8_decode($costo_unidad),
                            utf8_decode($costo_total),
                            utf8_decode('BOLIVIANOS'),
                            utf8_decode('')
                            ));
        }

        $this->Ln(15);
        $this->SetFont('Arial', 'B', 9);
        $id='Lista_de_Ingresos_Economicos_'.$val; 
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