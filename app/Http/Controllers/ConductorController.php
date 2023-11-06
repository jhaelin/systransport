<?php

namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelConductor; 
use App\ModelEmpresa;
use Session;

class ConductorController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('conductor.ViewIndex')->with('data',ModelConductor::conductor())->with('vf',ModelConductor::vconductor())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){
            return view('conductor.ViewNew')->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2){
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
            'nombre'=>'required|string|max:60',
            //'materno'=>'required|string|max:60',
            'ci'=>'required|integer',
            'exp'=>'required|string',
            'licencia'=>'required',
            'cel'=>'required|integer',
            'ciudad'=>'required|string|max:200',
            // 'zona'=>'required|string|max:100',
            // 'calle'=>'required|string|max:100',
            // 'num'=>'required|integer'
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 

            $data = array( 
              'nombre_con'=>mb_strtoupper($post['nombre']),
              'paterno_con'=>mb_strtoupper($post['paterno']),
              'materno_con'=>mb_strtoupper($post['materno']),
              'ci_con'=>$post['ci'],
              'expedido_con'=>mb_strtoupper($post['exp']),
              'categoria_licencia'=>mb_strtoupper($post['licencia']),
              'celular_con' =>$post['cel'],
              'telefono_con' =>$post['tel'],
              'direccion_con' =>mb_strtoupper($post['ciudad']),
              // 'zona_con' =>mb_strtoupper($post['zona']),
              // 'calle_con' =>mb_strtoupper($post['calle']),
              // 'numero_con'=>$post['num']
              );
            $resul = ModelConductor::store($data);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/conductor');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/conductor');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function show($id){}

    public function edit($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelConductor::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('conductor.ViewEdit', compact('row','id','e'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function update(Request $request, $id){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $usuario = Auth::user()->id;
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(), 
                [ 
                    'nombre'=>'required|string|max:60',
                    //'materno'=>'required|string|max:60',
                    'ci'=>'required|integer',
                    'exp'=>'required|string',
                    'licencia'=>'required',
                    'cel'=>'required|integer',
                    'ciudad'=>'required|string|max:200',
                    // 'zona'=>'required|string|max:100',
                    // 'calle'=>'required|string|max:100',
                    // 'num'=>'required|integer'
                ]);
          if($v->fails()){return redirect()->back()->withErrors($v->errors());}
          else{
                $data = array( 
                      'nombre_con'=>mb_strtoupper($post['nombre']),
                      'paterno_con'=>mb_strtoupper($post['paterno']),
                      'materno_con'=>mb_strtoupper($post['materno']),
                      'ci_con'=>$post['ci'],
                      'expedido_con'=>mb_strtoupper($post['exp']),
                      'categoria_licencia'=>mb_strtoupper($post['licencia']),
                      'celular_con' =>$post['cel'],
                      'telefono_con' =>$post['tel'],
                      'direccion_con' =>mb_strtoupper($post['ciudad']),
                      // 'zona_con' =>mb_strtoupper($post['zona']),
                      // 'calle_con' =>mb_strtoupper($post['calle']),
                      // 'numero_con'=>$post['num']
                  );
            $resul = ModelConductor::updat($data,$id);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue Modificado exitosamente ...!!!');
            return redirect('/conductor');
          }else{
            \Session::flash('message','Registro no fue Modificado');
            return redirect('/conductor');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $row = ModelConductor::edit($id);
        if(count($row)){
         return view('conductor.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelConductor::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/conductor');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/conductor');
      }
    }else{ return view('errors/403'); }
    }
}
