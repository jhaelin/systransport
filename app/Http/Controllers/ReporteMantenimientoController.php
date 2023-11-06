<?php
namespace App\Http\Controllers; 
use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\ModelMantenimientoCamion;
use App\ModelCamion;
use App\ModelEmpresa;
class ReporteMantenimientoController extends Controller 
{  
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function repHistMantenimiento(){ 
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View6HistMantenimiento')->with('camion',ModelCamion::camion())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repHisManjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
        $val=$post['val'];
           $cam=ModelCamion::edit($val);
           $data=ModelMantenimientoCamion::repHisManjq($val); 

          $img= 'uploads_files/'.$cam->foto_cam;

           $dato.='<div class="col-xs-8"><table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center active txt">Matricula</th>
                <th class="text-center txt">'.$cam->matricula.'</th>
              </tr>
              <tr>
                <th class="text-center active txt">Modelo</th>
                <th class="text-center txt">'.$cam->modelo.'</th>
              </tr>
              <tr>
                <th class="text-center active txt">Marca</th>
                <th class="text-center txt">'.$cam->marca.'</th>
              </tr>
              <tr>
                <th class="text-center active txt">Tipo Vehículo</th>
                <th class="text-center txt">'.$cam->tipo_vehiculo.'</th>
              </tr>
              <tr>
                <th class="text-center active txt">Descripción</th>
                <th class="text-justify txt">'.$cam->descripcion_cam.'</th>
              </tr>
            </thead></table></div>';

            $dato.='<div class="col-xs-4"><center><img src="'.$img.'" style="height:120px; width:250px"></center>

              <table class="table table-bordered"><tr>
                <th class="text-center active txt">Fecha Registro</th>
                <th class="text-center txt">'.$cam->fecha_registro.'</th>
              </tr></table>
            </div>';

            $dato.='<table class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th class="text-center tab_temp txt">N°</th>
                    <th class="text-center tab_temp txt">Mantenimiento</th>
                    <th class="text-center tab_temp txt">Observaciones</th>
                    <th class="text-center tab_temp txt">Fecha Registro</th>
                    <th class="text-center tab_temp txt">Fecha Próxima Revisión</th>
                  </tr>
              </thead>
              <tbody>';

           foreach ($data as $value){
            if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-justify txt">'.$value->mantenimiento.'</td>
                        <td class="text-justify txt">'.$value->observacion.'</td>
                        <td class="text-center txt">'.$value->fecha_man.'</td>
                        <td class="text-center txt">'.$value->fecha_prox_revision.'</td></tr>'; 
            }         
          }
          $dato.='</tbody></table>';        
          return $dato;       
        }else{}
      }
    

    public function repMantenimiento(){ 
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View7Mantenimiento')->with('camion',ModelCamion::camion())->with('e',ModelEmpresa::emp())
        ->with('data',ModelMantenimientoCamion::repManjq());
        }else{ return view('errors.403'); }
    }

    public function repManjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
            $val=$post['val']; $val1=$post['val1']; $val2=$post['val2'];

            if(($val=='TODO') && ($val1=='')&&($val2=='TODO')){
                 $data=ModelMantenimientoCamion::repManjq();  
                 $cont=1;
                 foreach ($data as $value){
                    if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$cont.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->marca.'</td>
                                <td class="text-center txt">'.$value->modelo.'</td>
                                <td class="text-justify txt">'.$value->tipo_vehiculo.'</td>
                                <td class="text-justify txt">'.$value->mantenimiento.'</td>
                                <td class="text-justify txt">'.$value->observacion.'</td>
                                <td class="text-center txt">'.$value->fecha_man.'</td>
                                <td class="text-center txt">'.$value->fecha_prox_revision.'</td></tr>';
                    $cont++;
                    }
                  }        
                return $dato; 
            }elseif($val=='TODO' && $val1=='' && $val2!='TODO'){
              $data=ModelMantenimientoCamion::repManjq1($val2);  
                 $cont=1;
                 foreach ($data as $value){
                    if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$cont.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->marca.'</td>
                                <td class="text-center txt">'.$value->modelo.'</td>
                                <td class="text-justify txt">'.$value->tipo_vehiculo.'</td>
                                <td class="text-justify txt">'.$value->mantenimiento.'</td>
                                <td class="text-justify txt">'.$value->observacion.'</td>
                                <td class="text-center txt">'.$value->fecha_man.'</td>
                                <td class="text-center txt">'.$value->fecha_prox_revision.'</td></tr>';
                    $cont++;
                    }
                  }          
                return $dato; 
            }elseif($val!='TODO' && $val1!='' && $val2=='TODO'){
              $data=ModelMantenimientoCamion::repManjq2($val,$val1); 
                 $cont=1;
                 foreach ($data as $value){
                    if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$cont.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->marca.'</td>
                                <td class="text-center txt">'.$value->modelo.'</td>
                                <td class="text-justify txt">'.$value->tipo_vehiculo.'</td>
                                <td class="text-justify txt">'.$value->mantenimiento.'</td>
                                <td class="text-justify txt">'.$value->observacion.'</td>
                                <td class="text-center txt">'.$value->fecha_man.'</td>
                                <td class="text-center txt">'.$value->fecha_prox_revision.'</td></tr>';
                    $cont++;
                    }
                  }        
                return $dato;

            }elseif($val!='TODO' && $val1!='' && $val2!='TODO'){
              $data=ModelMantenimientoCamion::repManjq3($val,$val1,$val2);    
                 $cont=1;
                 foreach ($data as $value){
                    if($value->observacion!='' &&$value->fecha_man!='' && $value->fecha_prox_revision!=''){
                      $dato.='<tr>                                
                                <td class="text-center txt">'.$cont.'</td>
                                <td class="text-center txt">'.$value->matricula.'</td>
                                <td class="text-center txt">'.$value->marca.'</td>
                                <td class="text-center txt">'.$value->modelo.'</td>
                                <td class="text-justify txt">'.$value->tipo_vehiculo.'</td>
                                <td class="text-justify txt">'.$value->mantenimiento.'</td>
                                <td class="text-justify txt">'.$value->observacion.'</td>
                                <td class="text-center txt">'.$value->fecha_man.'</td>
                                <td class="text-center txt">'.$value->fecha_prox_revision.'</td></tr>';
                    $cont++;
                    }
                  }          
                return $dato;             
            }else{}
        }
    }

}
