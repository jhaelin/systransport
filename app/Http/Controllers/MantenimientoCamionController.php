<?php
  
namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelMantenimientoCamion; 
use App\ModelCamion;
use App\ModelCliente;
use App\ModelConductor; 
use App\ModelRuta;   
use App\ModelEmpresa;
use Session;

class MantenimientoCamionController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('mantenimiento_camion.ViewIndex')->with('data',ModelMantenimientoCamion::mantenimiento())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    // public function create(){        
    //     $rol = Auth::user()->id_rol;
    //     if($rol==1 || $rol==2){
    //         return view('mantenimiento_camion.ViewNew')->with('camion',ModelCamion::camion())->with('e',ModelEmpresa::emp());
    //     }else{ return view('errors.403'); }
    // }

    public function show($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelCamion::edit($id);
            $mant=ModelMantenimientoCamion::manteni();
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('mantenimiento_camion.ViewNew', compact('row','id','e','mant'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){
      //var_dump($id);exit();
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2|| $rol==3 ){
        $usuario = Auth::user()->id;
        $post=$request->all(); 

      //var_dump($post);exit();
        if(count($post) > 0 ){
            $resul = ModelMantenimientoCamion::store($request);
          if($resul > 0){
            \Session::flash('message','Registro fue Registrado exitosamente ...!!!');
            return redirect('/mantenimiento');
          }else{
            \Session::flash('message','Registro no fue Registrado');
            return redirect('/mantenimiento');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        //var_dump($id);exit();
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelMantenimientoCamion::edit($id);

            $cam=ModelCamion::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('mantenimiento_camion.ViewEdit', compact('row','id','e','cam'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function update(Request $request, $id){
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2|| $rol==3 ){
        $usuario = Auth::user()->id;
        $post=$request->all(); 
        if(count($post) > 0 ){
            $resul = ModelMantenimientoCamion::updat($request, $id);
          if($resul > 0){
            \Session::flash('message','Registro fue Registrado exitosamente ...!!!');
            return redirect('/mantenimiento');
          }else{
            \Session::flash('message','Registro no fue Registrado');
            return redirect('/mantenimiento');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function modalAdd($id,Request $request){        
        $id = Crypt::decrypt($id);
        //var_dump($id);exit();
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelMantenimientoCamion::editModal($id);
            $cam=ModelCamion::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('mantenimiento_camion.ViewModal', compact('row','id','e','cam'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function Add(Request $request){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
            'id_camion'=>'required|integer',
            'id_mantenimiento'=>'required|integer',
            'fecha_man'=>'required|date',
            'fecha_prox'=>'required|date',
            'observacion'=>'required|string|max:500'
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 

            $data = array( 
              'id_camion'=>strtoupper($post['id_camion']),
              'id_mantenimiento'=>strtoupper($post['id_mantenimiento']),
              'fecha_man'=>strtoupper($post['fecha_man']),
              'fecha_prox_revision'=>$post['fecha_prox'],
              'observacion'=>mb_strtoupper($post['observacion'])
              );
            $resul = ModelMantenimientoCamion::add($data);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/mantenimiento');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/mantenimiento');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $row = ModelMantenimientoCamion::edit($id);
        $cam=ModelCamion::edit($id);
       //var_dump($row);exit();
        if(count($row)>0){
         return view('mantenimiento_camion.ViewDelete')->with('row', $row)->with('cam', $cam)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelMantenimientoCamion::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/mantenimiento');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/mantenimiento');
      }
    }else{ return view('errors/403'); }
    }
}
