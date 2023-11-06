<?php
namespace App\Http\Controllers; 
use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\ModelCamion;
use App\ModelCliente;
use App\ModelConductor;
use App\ModelEmpresa;
class ReporteCamCliConController extends Controller
{  
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function repCamion(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View2Camion')->with('data',ModelCamion::camion())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repCamjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
        $val=$post['val'];
        if($val=='TODO'){
           $data=ModelCamion::camion();  
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-center txt">'.$value->matricula.'</td>
                        <td class="text-center txt">'.$value->marca.'</td>
                        <td class="text-justify txt">'.$value->modelo.'</td>
                        <td class="text-justify txt">'.$value->descripcion_cam.'</td>
                        <td class="text-justify txt">'.$value->tipo_vehiculo.'</td>
                        <td class="text-center txt">'.$value->fecha_registro.'</td></tr>';          
          }        
          return $dato;       
        }else{
           $data=ModelCamion::reporteCamion($val);
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-center txt">'.$value->matricula.'</td>
                        <td class="text-center txt">'.$value->marca.'</td>
                        <td class="text-justify txt">'.$value->modelo.'</td>
                        <td class="text-justify txt">'.$value->descripcion_cam.'</td>
                        <td class="text-justify txt">'.$value->tipo_vehiculo.'</td>
                        <td class="text-center txt">'.$value->fecha_registro.'</td></tr>';          
          }        
          return $dato; 
        }
      }
    }

    //REPORTE DE CLIENTES

    public function repCliente(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View3Cliente')->with('data',ModelCliente::cliente())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repClijq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
        $val=$post['val'];
        if($val=='TODO'){
           $data=ModelCliente::cliente();  
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-center txt">'.$value->nit.'</td>
                        <td class="text-center txt">'.$value->razon_social.'</td>
                        <td class="text-justify txt">'.$value->nro_autorizacion.'</td>
                        <td class="text-justify txt">'.$value->nombre_representante.'</td>
                        <td class="text-justify txt">'.$value->ci_representante.'</td>
                        <td class="text-center txt">'.$value->ciudad_cli.' z:'.$value->zona_cli.' c:'.$value->calle_cli.' n°:'.$value->numero_cli.'</td> 
                        <td class="text-justify txt">'.$value->email_cli.'</td>
                        <td class="text-justify txt">'.$value->fax_cli.'</td>
                        <td class="text-center txt">'.$value->telefono_cli.'/'.$value->celular_cli.'</td></tr>';          
          }        
          return $dato;       
        }else{
           $data=ModelCliente::reporteCliente($val);
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-center txt">'.$value->nit.'</td>
                        <td class="text-center txt">'.$value->razon_social.'</td>
                        <td class="text-justify txt">'.$value->nro_autorizacion.'</td>
                        <td class="text-justify txt">'.$value->nombre_representante.'</td>
                        <td class="text-justify txt">'.$value->ci_representante.'</td>
                        <td class="text-center txt">'.$value->ciudad_cli.' z:'.$value->zona_cli.' c:'.$value->calle_cli.' n°:'.$value->numero_cli.'</td> 
                        <td class="text-justify txt">'.$value->email_cli.'</td>
                        <td class="text-justify txt">'.$value->fax_cli.'</td>
                        <td class="text-center txt">'.$value->telefono_cli.'/'.$value->celular_cli.'</td></tr>';        
          }        
          return $dato; 
        }
      }
    }

    //REPORTE DE CONDUCTOR

    public function repConductor(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View4Conductor')->with('data',ModelConductor::conductor())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repConjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
        $val=$post['val'];
        if($val=='TODO'){
           $data=ModelConductor::conductor();  
           foreach ($data as $value){ 
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-center txt">'.$value->nombre_con.'</td>
                        <td class="text-center txt">'.$value->paterno_con.'</td>
                        <td class="text-justify txt">'.$value->materno_con.'</td>
                        <td class="text-justify txt">'.$value->ci_con.' '.$value->expedido_con.'</td>
                        <td class="text-justify txt">'.$value->categoria_licencia.'</td>
                        <td class="text-center txt">Ciudad:'.$value->direccion_con.'</td> 
                        <td class="text-center txt">'.$value->telefono_con.'/'.$value->celular_con.'</td>
                        <td class="text-justify txt"></td></tr>';          
          }        
          return $dato;       
        }else{
           $data=ModelConductor::reporteConductor($val);
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-center txt">'.$value->nombre_con.'</td>
                        <td class="text-center txt">'.$value->paterno_con.'</td>
                        <td class="text-justify txt">'.$value->materno_con.'</td>
                        <td class="text-justify txt">'.$value->ci_con.' '.$value->expedido_con.'</td>
                        <td class="text-justify txt">'.$value->categoria_licencia.'</td>
                        <td class="text-center txt">Ciudad:'.$value->direccion_con.'</td> 
                        <td class="text-center txt">'.$value->telefono_con.'/'.$value->celular_con.'</td>
                        <td class="text-justify txt"></td></tr>';        
          }        
          return $dato; 
        }
      }
    }
}
