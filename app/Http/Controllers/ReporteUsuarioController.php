<?php
namespace App\Http\Controllers; 
use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\ModelUsuario;
use App\ModelEmpresa;
class ReporteUsuarioController extends Controller
{  
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function repUsuario(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('reporte.View1Usuario')->with('data',ModelUsuario::usuario())
                                           ->with('tipo',ModelUsuario::tipo())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function repUsjq(Request $request){ 
      $post=$request->all(); $numero=0; $dato='';
      if($post!=''){
        $val=$post['val'];
        if($val=='TODO'){
           $data=ModelUsuario::usuario();  
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-justify txt">'.$value->paterno.' '.$value->materno.' '.$value->nombre.'</td>
                        <td class="text-justify txt">'.$value->ci.''.$value->expedido.'</td>
                        <td class="text-justify txt">'.$value->telefono.'</td>
                        <td class="text-justify txt">'.$value->celular.'</td>
                        <td class="text-justify txt">Z: '.$value->zona.' C/: '.$value->calle.' N°: '.$value->numero.'</td>
                        <td class="text-justify txt">'.$value->tipo_usuario.'</td>
                        <td class="text-justify txt">'.$value->estado_usuario.'</td>
                        <td class="text-center txt">'.$value->codigo_usuario.'</td></tr>';          
            }        
          return $dato;       
        }else{
           $data=ModelUsuario::ustipo($val);
           foreach ($data as $value){
           $numero=$numero+1;
                $dato.='<tr>
                        <td class="text-center txt">'.$numero.'</td>
                        <td class="text-justify txt">'.$value->paterno.' '.$value->materno.' '.$value->nombre.'</td>
                        <td class="text-justify txt">'.$value->ci.''.$value->expedido.'</td>
                        <td class="text-justify txt">'.$value->telefono.'</td>
                        <td class="text-justify txt">'.$value->celular.'</td>
                        <td class="text-justify txt">Z: '.$value->zona.' C/: '.$value->calle.' N°: '.$value->numero.'</td>
                        <td class="text-justify txt">'.$value->tipo_usuario.'</td>
                        <td class="text-justify txt">'.$value->estado_usuario.'</td>
                        <td class="text-center txt">'.$value->codigo_usuario.'</td></tr>';          
            }        
          return $dato; 
        }
      }
    }

}
