<?php

namespace App\Http\Controllers;

use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\ModelRuta;
use App\ModelEmpresa;

class RutaController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('ruta.ViewIndex')->with('data',ModelRuta::ruta())->with('vc',ModelRuta::vruta())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        return view('ruta.ViewNew')->with('e',ModelEmpresa::emp());
      }else{ return view('errors/403'); }
    }

    public function store(Request $request){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
            'nombre'=>'required|string|max:1000',
            'distancia'=>'required|string|max:100',
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 

            $data = array( 
              'nombre_ruta'      =>mb_strtoupper($post['nombre']),
              'distancia_km' =>mb_strtoupper($post['distancia']),
              'descripcion_ruta' =>mb_strtoupper($post['descripcion'])
              );
            $resul = ModelRuta::store($data);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/ruta');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/ruta');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function show($id){}

    public function edit($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelRuta::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('ruta.ViewEdit', compact('row','id','e'));
            }else{return view('errors/404');}
          }
    }

    public function update(Request $request, $id){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $usuario = Auth::user()->id;
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(), 
                [ 
                    'nombre'=>'required|string|max:1000',
                    'distancia'=>'required|string|max:100',
                ]);
          if($v->fails()){return redirect()->back()->withErrors($v->errors());}
          else{
                $data = array( 
                      'nombre_ruta'      =>mb_strtoupper($post['nombre']),
                      'distancia_km' =>mb_strtoupper($post['distancia']),
                      'descripcion_ruta' =>mb_strtoupper($post['descripcion'])
                  );
            $resul = ModelRuta::updat($data,$id);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue Modificado exitosamente ...!!!');
            return redirect('/ruta');
          }else{
            \Session::flash('message','Registro no fue Modificado');
            return redirect('/ruta');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $row = ModelRuta::edit($id);
        if(count($row)){
         return view('ruta.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelRuta::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ..');
        return redirect('/ruta');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/ruta');
      }
    }else{ return view('errors/403'); }
    }
}
