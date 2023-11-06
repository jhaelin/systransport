<?php

namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Illuminate\Http\Request; 
use App\ModelCamion; 
use App\ModelEmpresa;
use Storage;
use Session;

class CamionController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('camion.ViewIndex')->with('data',ModelCamion::camion())->with('vf',ModelCamion::vcamion())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){
            return view('camion.ViewNew')->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){          
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){    
            $dato=new ModelCamion();
            $dato->matricula=mb_strtoupper($request->matricula);
            $dato->marca=mb_strtoupper($request->marca);
            $dato->modelo=mb_strtoupper($request->modelo);
            $dato->tipo_vehiculo=mb_strtoupper($request->tipo);
            $dato->fecha_registro=$request->fecha;
            $dato->descripcion_cam=mb_strtoupper($request->descripcion);

            if($request->archivo=='') {
              $archivo='camion_defecto.jpg';
              $archivo_tipo='public/uploads_files/camion_defecto.jpg';
              $archivo_tamanio='43,1';
            }
            elseif ($request->archivo!='') {
              ///var_dump($request->archivo);exit();
              $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,Á,É,Í,Ó,Ú,ñ,Ñ");
              $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,A,E,I,O,U,ni,NI");
              $archivo_nombre = $request->file('archivo'); 
              $nuevo_archivo=time().'_'.$archivo_nombre->getClientOriginalName();
              $archivo_tipo  = $archivo_nombre->getClientOriginalExtension();
              $archivo_tamanio  = $archivo_nombre->getClientSize();
              $archivo = str_replace($search, $replace, $nuevo_archivo);
              Storage::disk('uploads_files')->put($archivo,file_get_contents($request->archivo->getRealPath()));
            }
            $dato->foto_cam=$archivo;
            $dato->ruta_cam='public/uploads_files/'.$archivo;
            $dato->tipo_cam=$archivo_tipo;
            $dato->tamanio_cam=$archivo_tamanio;
            if($dato->save()){
              Session::flash('msg','CORRECTO');
              \Session::flash('message','Registro fue guardado exitosamente ...!!!');
              return redirect('/camion');
            }else{
              Session::flash('msg','ERROR');
              \Session::flash('message','Registro no fue guardado');
              return back();
            }
      }else{ return view('errors.403'); }
    }

    public function show($id){}

    public function edit($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelCamion::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('camion.ViewEdit', compact('row','id','e'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function update(Request $request, $id){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $post=$request->all(); 
            if($request->file('archivo')){
                if ($request->archivo=='') {
                    $archivo=$request->archivo_2;
                    $archivo_tipo='';
                    $archivo_tamanio='';
                }elseif ($request->archivo!='') {
                  $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,Á,É,Í,Ó,Ú,ñ,Ñ");
                  $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,A,E,I,O,U,ni,NI");
                  $archivo_nombre = $request->file('archivo'); 
                  $nuevo_archivo=time().'_'.$archivo_nombre->getClientOriginalName();
                  $archivo_tipo  = $archivo_nombre->getClientOriginalExtension();
                  $archivo_tamanio  = $archivo_nombre->getClientSize();
                  $archivo = str_replace($search, $replace, $nuevo_archivo);
                  Storage::disk('uploads_files')->put($archivo,file_get_contents($request->archivo->getRealPath()));
                }
                        $data = array( 
                          'matricula'  =>mb_strtoupper($post['matricula']),
                          'marca' =>mb_strtoupper($post['marca']),
                          'modelo' =>mb_strtoupper($post['modelo']),
                          'tipo_vehiculo'      =>mb_strtoupper($post['tipo']),
                          'fecha_registro'=>$post['fecha'],
                          'descripcion_cam'    =>mb_strtoupper($post['descripcion']),

                          'foto_cam'    =>$archivo,
                          'ruta_cam'    =>'public/uploads_files/'.$archivo,
                          'tipo_cam'    =>$archivo_tipo,
                          'tamanio_cam' =>$archivo_tamanio
                          );
                }else{
                        $data = array( 
                          'matricula'  =>mb_strtoupper($post['matricula']),
                          'marca' =>mb_strtoupper($post['marca']),
                          'modelo' =>mb_strtoupper($post['modelo']),
                          'tipo_vehiculo'      =>mb_strtoupper($post['tipo']),
                          'fecha_registro'=>$post['fecha'],
                          'descripcion_cam'    =>mb_strtoupper($post['descripcion'])
                          );
                }
            $resul = ModelCamion::updat($data,$id);
            if($resul>0)
            {
              Session::flash('msg','CORRECTO');
             \Session::flash('message','Registro fue modificado exitosamente ...!!!');
              return redirect('/camion');
            }else{
              Session::flash('msg','ERROR');
              \Session::flash('message','Registro no fue modificado');
              return back();
            }
      }else{ return view('errors.403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $row = ModelCamion::edit($id);
        if(count($row)){
         return view('camion.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelCamion::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/camion');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/camion');
      }
    }else{ return view('errors/403'); }
    }
}
