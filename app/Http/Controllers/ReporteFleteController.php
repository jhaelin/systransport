<?php
namespace App\Http\Controllers; 
use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\ModelAdminFleteCamion;
use App\ModelEmpresa;
class ReporteFleteController extends Controller
{  
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function repFlete(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View5Flete')->with('data',ModelAdminFleteCamion::flete())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repFlejq(Request $request){  
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
            $val=$post['val']; $val1=$post['val1'];$val2=$post['val2'];

            if(($val=='TODO') && ($val1=='') && ($val2=='TODO')){
                 $data=ModelAdminFleteCamion::flete();  
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->matricula.' '.$value->marca.' '.$value->modelo.'</td>
                                <td class="text-center txt">'.$value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con.'</td>
                                <td class="text-justify txt">'.$value->nit.' '.$value->razon_social.'</td>
                                <td class="text-justify txt">'.$value->nombre_ruta.', km:'.$value->distancia_km.'</td>
                                <td class="text-justify txt">'.$value->descripcion_flete.'</td>
                                <td class="text-center txt">'.$value->fecha_flete.'</td>
                                <td class="text-center txt">'.$value->estado_flete.'</td></tr>';  
                  }        
                return $dato; 
            }elseif($val=='TODO'&& $val1=='' && $val2!='TODO'){
              $data=ModelAdminFleteCamion::reporteFlete1($val2);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->matricula.' '.$value->marca.' '.$value->modelo.'</td>
                                <td class="text-center txt">'.$value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con.'</td>
                                <td class="text-justify txt">'.$value->nit.' '.$value->razon_social.'</td>
                                <td class="text-justify txt">'.$value->nombre_ruta.', km:'.$value->distancia_km.'</td>
                                <td class="text-justify txt">'.$value->descripcion_flete.'</td>
                                <td class="text-center txt">'.$value->fecha_flete.'</td>
                                <td class="text-center txt">'.$value->estado_flete.'</td></tr>'; 
                  }        
                return $dato;              
            }elseif($val!='TODO'&& $val1!=''&& $val2=='TODO'){
              $data=ModelAdminFleteCamion::reporteFlete2($val,$val1);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->matricula.' '.$value->marca.' '.$value->modelo.'</td>
                                <td class="text-center txt">'.$value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con.'</td>
                                <td class="text-justify txt">'.$value->nit.' '.$value->razon_social.'</td>
                                <td class="text-justify txt">'.$value->nombre_ruta.', km:'.$value->distancia_km.'</td>
                                <td class="text-justify txt">'.$value->descripcion_flete.'</td>
                                <td class="text-center txt">'.$value->fecha_flete.'</td>
                                <td class="text-center txt">'.$value->estado_flete.'</td></tr>';  
                }  
                return $dato;    
            }elseif($val!='TODO'&& $val1!=''&& $val2!='TODO'){
              $data=ModelAdminFleteCamion::reporteFlete3($val,$val1,$val2);   
                 foreach ($data as $value){
                      $numero=$numero+1;
                      $dato.='<tr>
                                <td class="text-center txt">'.$numero.'</td>
                                <td class="text-center txt">'.$value->matricula.' '.$value->marca.' '.$value->modelo.'</td>
                                <td class="text-center txt">'.$value->nombre_con.' '.$value->paterno_con.' '.$value->materno_con.'</td>
                                <td class="text-justify txt">'.$value->nit.' '.$value->razon_social.'</td>
                                <td class="text-justify txt">'.$value->nombre_ruta.', km:'.$value->distancia_km.'</td>
                                <td class="text-justify txt">'.$value->descripcion_flete.'</td>
                                <td class="text-center txt">'.$value->fecha_flete.'</td>
                                <td class="text-center txt">'.$value->estado_flete.'</td></tr>';   
                }  
                return $dato;  
            }else{}
        }
    }

    //REPORTE DE CLIENTES

}
