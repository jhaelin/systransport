<?php 

namespace App\Http\Controllers; 
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelAdminFleteCamion; 
use App\ModelCamion;
use App\ModelCliente;
use App\ModelConductor;  
use App\ModelRuta;   
use App\ModelEmpresa;
use Session;

class AdminFleteCamionController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=2){
        return view('admin_flete_camion.ViewIndex')->with('data',ModelAdminFleteCamion::flete())->with('vf',ModelAdminFleteCamion::vflete())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){
            return view('admin_flete_camion.ViewNew')->with('camion',ModelCamion::camion())->with('cliente',ModelCliente::cliente())
            ->with('conductor',ModelConductor::conductor())->with('ruta',ModelRuta::ruta())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2){
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
            'camion'=>'required|integer',
            'conductor'=>'required|integer',
            'cliente'=>'required|integer',
            'ruta'=>'required|integer',
            'fecha'=>'required|date',
            //'estado'=>'required',
            //'descripcion'=>'required|string|max:1000'
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 
                $id_camion=$post['camion'];
            $data = array( 
              'id_camion'=>$id_camion,
              'id_conductor'=>$post['conductor'],
              'id_cliente'=>$post['cliente'],
              'id_ruta'=>$post['ruta'],
              'fecha_flete'=>$post['fecha'],
              //'estado_flete'=>strtoupper($post['licencia']),
              'descripcion_flete' =>mb_strtoupper($post['descripcion'])
              );
            $resul = ModelAdminFleteCamion::store($data);
            $resul2 = ModelAdminFleteCamion::delete_e($id_camion);
          }
          if($resul > 0 && $resul2>0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/flete');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/flete');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }



    public function edit($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelAdminFleteCamion::edit($id);
            $camion=ModelCamion::camion();
            $cliente=ModelCliente::cliente();
            $conductor=ModelConductor::conductor();
            $ruta=ModelRuta::ruta();
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('admin_flete_camion.ViewEdit', compact('row','id','e','camion','cliente','conductor','ruta'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function update(Request $request, $id){
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2){
        $usuario = Auth::user()->id;
        $post=$request->all(); 
        //var_dump($post);exit();
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(), 
                [ 
                    'camion'=>'required|integer',
                    'conductor'=>'required|integer',
                    'cliente'=>'required|integer',
                    'ruta'=>'required|integer',
                    'fecha'=>'required|date',
                    //'estado'=>'required',
                    //'descripcion'=>'required|string|max:1000'
                ]);
          if($v->fails()){return redirect()->back()->withErrors($v->errors());}
          else{
                $data = array(
                          'id_camion'=>$post['camion'],
                          'id_conductor'=>$post['conductor'],
                          'id_cliente'=>$post['cliente'],
                          'id_ruta'=>$post['ruta'],
                          'fecha_flete'=>$post['fecha'],
                          //'estado_flete'=>$post['estado'],
                          'descripcion_flete' =>mb_strtoupper($post['descripcion'])
                  );
            $resul = ModelAdminFleteCamion::updat($data,$id);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue Modificado exitosamente ...!!!');
            return redirect('/flete');
          }else{
            \Session::flash('message','Registro no fue Modificado');
            return redirect('/flete');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2){
        $row = ModelAdminFleteCamion::edit($id);
        if(count($row)){
         return view('admin_flete_camion.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if( $rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelAdminFleteCamion::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/flete');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/flete');
      }
    }else{ return view('errors/403'); }
    }
}
