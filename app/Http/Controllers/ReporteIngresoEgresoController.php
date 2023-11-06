<?php
namespace App\Http\Controllers;  
use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\ModelEgreso;
use App\ModelCliente;
use App\ModelIngreso;
use App\ModelEmpresa;
class ReporteIngresoEgresoController extends Controller
{  
    public function __construct(){
        $this->middleware('auth'); 
    }
    
    // REPORTE EGRESO
    public function repEgreso(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View9Egreso')->with('data',ModelEgreso::egreso())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repEgjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato=''; $cantidad=0; $costo_unidad=0;$costo_total=0;
      if($post!=''){
            $val=$post['val']; $val1=$post['val1'];

            if(($val=='TODO') && ($val1=='')){
                 $data=ModelEgreso::egreso();  
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr> 
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->nro_factura.'</td>
                                <td class="text-center txt">'.$value->concepto_pago.'</td>
                                <td class="text-center txt">'.$value->cantidad.'</td>
                                <td class="text-right txt">'.$value->costo_unidad.'</td>
                                <td class="text-right txt">'.$value->costo_total.'</td>
                                <td class="text-center txt">'.$value->observacion.'</td>
                                <td class="text-center txt">'.$value->fecha_e.'</td></tr>';
                                $cantidad=$cantidad+$value->cantidad; 
                                $costo_unidad=$costo_unidad+$value->costo_unidad;
                                $costo_total=$costo_total+$value->costo_total; 
                  }  

                   $dato.='<tr>
                      <td class="text-center  txt" colspan="3">TOTAL</td>
                      <td class="text-center txt">'.$cantidad.'</td>
                      <td class="text-right txt">'.$costo_unidad.'</td>
                      <td class="text-right txt">'.$costo_total.'</td>
                      <td class="text-justify txt">BOLIVIANOS</td>
                      <td class="text-justify txt"></td>
                    </tr>';    
                return $dato; 
            }elseif($val!='TODO'&& $val1!=''){
              $data=ModelEgreso::reporteEgreso($val,$val1);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->nro_factura.'</td>
                                <td class="text-center txt">'.$value->concepto_pago.'</td>
                                <td class="text-center txt">'.$value->cantidad.'</td>
                                <td class="text-right txt">'.$value->costo_unidad.'</td>
                                <td class="text-right txt">'.$value->costo_total.'</td>
                                <td class="text-center txt">'.$value->observacion.'</td>
                                <td class="text-center txt">'.$value->fecha_e.'</td></tr>';
                                $cantidad=$cantidad+$value->cantidad; 
                          $costo_unidad=$costo_unidad+$value->costo_unidad;
                          $costo_total=$costo_total+$value->costo_total;
                  }    

                   $dato.='<tr>
                      <td class="text-center  txt" colspan="3">TOTAL</td>
                      <td class="text-center txt">'.$cantidad.'</td>
                      <td class="text-right txt">'.$costo_unidad.'</td>
                      <td class="text-right txt">'.$costo_total.'</td>
                      <td class="text-justify txt">BOLIVIANOS</td>
                      <td class="text-justify txt"></td>
                    </tr>';      
                return $dato;              
            }else{}
        }
    }

    //REPORTE DE INGRESOS

    public function repIngreso(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View8Ingreso')->with('data',ModelIngreso::ingreso())
        ->with('cliente',ModelCliente::cliente())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }
    
    public function repIngjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato=''; $cantidad=0; $costo_unidad=0;$costo_total=0;
      if($post!=''){
            $val=$post['val']; $val1=$post['val1']; $val2=$post['val2'];

            if(($val=='TODO') && ($val1=='')&&($val2=='TODO')){
                 $data=ModelIngreso::ingreso();  
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->nro_transporte.'</td>
                                <td class="text-center txt">'.$value->fecha_ing.'</td>
                                <td class="text-justify txt">'.$value->codigo_ing.'</td>
                                <td class="text-justify txt">'.$value->nro_hoja_entrada.'</td>
                                <td class="text-justify txt">'.$value->doc_compra.'</td>
                                <td class="text-justify txt">'.$value->nombre_empresa.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->nro_gasto.'</td>
                                <td class="text-center txt">'.$value->hoja_trabajo.'</td>
                                <td class="text-justify txt">'.$value->razon_social.'</td>
                                <td class="text-center txt">'.$value->tonelada_tn.'</td>
                                <td class="text-right txt">'.$value->precio_unidad.'</td>
                                <td class="text-right txt">'.$value->total_costo_flete.'</td>
                                <td class="text-center txt">'.$value->nombre_ruta.'</td>
                                <td class="text-center txt">'.$value->nro_entrega.', '.$value->nro_entrega.'</td>
                                <td class="text-center txt">'.$value->nro_material_mercaderia.'</td>
                                <td class="text-justify txt">'.$value->fecha_registro_ing.'</td></tr>'; 
                                $cantidad=$cantidad+$value->tonelada_tn; 
                                $costo_unidad=$costo_unidad+$value->precio_unidad;
                                $costo_total=$costo_total+$value->total_costo_flete;  
                  }   

                  $dato.='<tr>
                      <td class="text-center  txt" colspan="11">TOTAL</td>
                      <td class="text-center txt">'.$cantidad.'</td>
                      <td class="text-right txt">'.$costo_unidad.'</td>
                      <td class="text-right txt">'.$costo_total.'</td>
                      <td class="text-justify txt">BOLIVIANOS</td>
                      <td class="text-justify txt" colspan="3"></td></tr>';      
                return $dato; 
            }elseif($val=='TODO' && $val1=='' && $val2!='TODO'){
              $data=ModelIngreso::reporteIngreso1($val2);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->nro_transporte.'</td>
                                <td class="text-center txt">'.$value->fecha_ing.'</td>
                                <td class="text-justify txt">'.$value->codigo_ing.'</td>
                                <td class="text-justify txt">'.$value->nro_hoja_entrada.'</td>
                                <td class="text-justify txt">'.$value->doc_compra.'</td>
                                <td class="text-justify txt">'.$value->nombre_empresa.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->nro_gasto.'</td>
                                <td class="text-center txt">'.$value->hoja_trabajo.'</td>
                                <td class="text-justify txt">'.$value->razon_social.'</td>
                                <td class="text-center txt">'.$value->tonelada_tn.'</td>
                                <td class="text-right txt">'.$value->precio_unidad.'</td>
                                <td class="text-right txt">'.$value->total_costo_flete.'</td>
                                <td class="text-center txt">'.$value->nombre_ruta.'</td>
                                <td class="text-center txt">'.$value->nro_entrega.', '.$value->nro_entrega.'</td>
                                <td class="text-center txt">'.$value->nro_material_mercaderia.'</td>
                                <td class="text-justify txt">'.$value->fecha_registro_ing.'</td></tr>';
                                $cantidad=$cantidad+$value->tonelada_tn; 
                                $costo_unidad=$costo_unidad+$value->precio_unidad;
                                $costo_total=$costo_total+$value->total_costo_flete;  
                  } 

                  $dato.='<tr>
                      <td class="text-center  txt" colspan="11">TOTAL</td>
                      <td class="text-center txt">'.$cantidad.'</td>
                      <td class="text-right txt">'.$costo_unidad.'</td>
                      <td class="text-right txt">'.$costo_total.'</td>
                      <td class="text-justify txt">BOLIVIANOS</td>
                      <td class="text-justify txt" colspan="3"></td></tr>';        
                return $dato; 
            }elseif($val!='TODO' && $val1!='' && $val2=='TODO'){
              $data=ModelIngreso::reporteIngreso2($val,$val1);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->nro_transporte.'</td>
                                <td class="text-center txt">'.$value->fecha_ing.'</td>
                                <td class="text-justify txt">'.$value->codigo_ing.'</td>
                                <td class="text-justify txt">'.$value->nro_hoja_entrada.'</td>
                                <td class="text-justify txt">'.$value->doc_compra.'</td>
                                <td class="text-justify txt">'.$value->nombre_empresa.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->nro_gasto.'</td>
                                <td class="text-center txt">'.$value->hoja_trabajo.'</td>
                                <td class="text-justify txt">'.$value->razon_social.'</td>
                                <td class="text-center txt">'.$value->tonelada_tn.'</td>
                                <td class="text-right txt">'.$value->precio_unidad.'</td>
                                <td class="text-right txt">'.$value->total_costo_flete.'</td>
                                <td class="text-center txt">'.$value->nombre_ruta.'</td>
                                <td class="text-center txt">'.$value->nro_entrega.', '.$value->nro_entrega.'</td>
                                <td class="text-center txt">'.$value->nro_material_mercaderia.'</td>
                                <td class="text-justify txt">'.$value->fecha_registro_ing.'</td></tr>';  
                                $cantidad=$cantidad+$value->tonelada_tn; 
                                $costo_unidad=$costo_unidad+$value->precio_unidad;
                                $costo_total=$costo_total+$value->total_costo_flete;
                  } 

                  $dato.='<tr>
                      <td class="text-center  txt" colspan="11">TOTAL</td>
                      <td class="text-center txt">'.$cantidad.'</td>
                      <td class="text-right txt">'.$costo_unidad.'</td>
                      <td class="text-right txt">'.$costo_total.'</td>
                      <td class="text-justify txt">BOLIVIANOS</td>
                      <td class="text-justify txt" colspan="3"></td></tr>';        
                return $dato;

            }elseif($val!='TODO' && $val1!='' && $val2!='TODO'){
              $data=ModelIngreso::reporteIngreso3($val,$val1,$val2);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->nro_transporte.'</td>
                                <td class="text-center txt">'.$value->fecha_ing.'</td>
                                <td class="text-justify txt">'.$value->codigo_ing.'</td>
                                <td class="text-justify txt">'.$value->nro_hoja_entrada.'</td>
                                <td class="text-justify txt">'.$value->doc_compra.'</td>
                                <td class="text-justify txt">'.$value->nombre_empresa.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->nro_gasto.'</td>
                                <td class="text-center txt">'.$value->hoja_trabajo.'</td>
                                <td class="text-justify txt">'.$value->razon_social.'</td>
                                <td class="text-center txt">'.$value->tonelada_tn.'</td>
                                <td class="text-right txt">'.$value->precio_unidad.'</td>
                                <td class="text-right txt">'.$value->total_costo_flete.'</td>
                                <td class="text-center txt">'.$value->nombre_ruta.'</td>
                                <td class="text-center txt">'.$value->nro_entrega.', '.$value->nro_entrega.'</td>
                                <td class="text-center txt">'.$value->nro_material_mercaderia.'</td>
                                <td class="text-justify txt">'.$value->fecha_registro_ing.'</td></tr>';
                                $cantidad=$cantidad+$value->tonelada_tn; 
                                $costo_unidad=$costo_unidad+$value->precio_unidad;
                                $costo_total=$costo_total+$value->total_costo_flete;  
                  }   

                  $dato.='<tr>
                      <td class="text-center  txt" colspan="11">TOTAL</td>
                      <td class="text-center txt">'.$cantidad.'</td>
                      <td class="text-right txt">'.$costo_unidad.'</td>
                      <td class="text-right txt">'.$costo_total.'</td>
                      <td class="text-justify txt">BOLIVIANOS</td>
                      <td class="text-justify txt" colspan="3"></td></tr>';    
                return $dato;             
            }else{}
        }
    }

    public function repImpuesto(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View10Impuesto')->with('egre',ModelEgreso::impEgreso())->with('ingr',ModelIngreso::impIngreso())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repImpjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
            $val=$post['val']; $val1=$post['val1'];

            if(($val=='TODO') && ($val1=='')){
                $egre=ModelEgreso::impEgreso();
                $ingr=ModelIngreso::impIngreso();  

                $ing=0; $egr=0; $diferencia=0; $iva=0; $ing_iue=0; $iue=0; $impTotalPago=0; $impTotalPagar=0;  $total=0;                                 
                $dato.='<tr>';

                if($ingr){
                  foreach($ingr as $key=>$val){  
                      $dato.='<td class="text-right txt">'.$val->total_ingreso.'</td>';
                      $ingr=$val->total_ingreso;
                  }
                }
                 $dato.='<th class="text-center txt"></th>';
                if($egre){
                  foreach($egre as $key=>$value) {      
                      $dato.='<td class="text-right txt">'.$value->total_egreso.'</td>';
                  }
                  $egre=$value->total_egreso;
                }
              $dato.='</tr>'; 
                    $diferencia= $ingr-$egre;
                    $iva=$diferencia*(0.13);
                    $ing_iue=$ing*(0.03);
                    $impTotalPago=$iva+$ing_iue;

                    $iue=$diferencia*(0.25);
                    $impTotalPagar=$iue;
              $dato.='<tr>
                      <td class="text-right txt"><b>TOTAL PAGO IMPUESTO</b></td>
                      <td class="text-right txt"><b>'.$impTotalPago.'</b></td>
                      <th class="text-center txt"></th>
              </tr>
              <tr>
                      <td class="text-right txt"><b>TOTAL PAGAR IUE</b></td>
                      <td class="text-right txt"><b>'.$impTotalPagar.'</b></td>
                      <th class="text-center txt"></th>
              </tr>';   

              $total=$impTotalPago+$impTotalPagar;

              $dato.='<tr>
                      <td class="text-right txt"><b>TOTAL A PAGAR</b></td>
                      <td class="text-right txt"><b>'.$total.'</b></td>
                      <th class="text-left txt"> BOLIVIANOS</th>
              </tr>';    
                return $dato; 
            }elseif($val!='TODO'&& $val1!=''){
                $egre=ModelEgreso::impEgreso1($val,$val1);
                $ingr=ModelIngreso::impIngreso1($val,$val1);  

                $ing=0; $egr=0; $diferencia=0; $iva=0; $ing_iue=0; $iue=0; $impTotalPago=0; $impTotalPagar=0;                                   
                $dato.='<tr>';

                if($ingr){
                  foreach($ingr as $key=>$val){  
                      $dato.='<td class="text-right txt">'.$val->total_ingreso.'</td>';
                      $ingr=$val->total_ingreso;
                  }
                }
                 $dato.='<th class="text-center txt"></th>';
                if($egre){
                  foreach($egre as $key=>$value) {      
                      $dato.='<td class="text-right txt">'.$value->total_egreso.'</td>';
                  }
                  $egre=$value->total_egreso;
                }
              $dato.='</tr>'; 
                    $diferencia= $ingr-$egre;
                    $iva=$diferencia*(0.13);
                    $ing_iue=$ing*(0.03);
                    $impTotalPago=$iva+$ing_iue;

                    $iue=$diferencia*(0.25);
                    $impTotalPagar=$iue;
              $dato.='<tr>
                      <td class="text-right txt"><b>TOTAL PAGO IMPUESTO</b></td>
                      <td class="text-right txt"><b>'.$impTotalPago.'</b></td>
                      <th class="text-center txt"></th>
              </tr>
              <tr>
                      <td class="text-right txt"><b>TOTAL PAGAR IUE</b></td>
                      <td class="text-right txt"><b>'.$impTotalPagar.'</b></td>
                      <th class="text-center txt"></th>
              </tr>';        

              $total=$impTotalPago+$impTotalPagar;

              $dato.='<tr>
                      <td class="text-right txt"><b>TOTAL A PAGAR</b></td>
                      <td class="text-right txt"><b>'.$total.'</b></td>
                      <th class="text-left txt"> BOLIVIANOS</th>
              </tr>';   
                return $dato;              
            }else{}
        }
    }

}
