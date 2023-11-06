<?php

namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelEgreso; 
use App\ModelEmpresa;
use Session;

class EgresoController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('egreso.ViewIndex')->with('data',ModelEgreso::egreso())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){
            return view('egreso.ViewNew')->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
            'factura'=>'required|integer',
            'fecha'=>'required|date',
            'concepto'=>'required|string|max:500',
            'cantidad'=>'required|integer',
            'unidad'=>'required',
            'total'=>'required'
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 

            $data = array( 
              'nro_factura'=>strtoupper($post['factura']),
              'concepto_pago'=>mb_strtoupper($post['concepto']),
              'observacion'=>mb_strtoupper($post['observacion']),
              'cantidad'=>$post['cantidad'],
              'costo_unidad' =>$post['unidad'],
              'costo_total' =>$post['total'],
              'fecha_e'=>$post['fecha']
              );
            $resul = ModelEgreso::store($data);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/egreso');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/egreso');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function show($id){}

    public function edit($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelEgreso::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('egreso.ViewEdit', compact('row','id','e'));
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
                    'factura'=>'required|integer',
                    'fecha'=>'required|date',
                    'concepto'=>'required|string|max:500',
                    'cantidad'=>'required|integer',
                    'unidad'=>'required',
                    'total'=>'required'
                ]);
          if($v->fails()){return redirect()->back()->withErrors($v->errors());}
          else{
                $data = array( 
                  'nro_factura'=>strtoupper($post['factura']),
                  'concepto_pago'=>mb_strtoupper($post['concepto']),
                  'observacion'=>mb_strtoupper($post['observacion']),
                  'cantidad'=>$post['cantidad'],
                  'costo_unidad' =>$post['unidad'],
                  'costo_total' =>$post['total'],
                  'fecha_e'=>$post['fecha']
                  );
            $resul = ModelEgreso::updat($data,$id);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue Modificado exitosamente ...!!!');
            return redirect('/egreso');
          }else{
            \Session::flash('message','Registro no fue Modificado');
            return redirect('/egreso');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $row = ModelEgreso::edit($id);
        if(count($row)){
         return view('egreso.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelEgreso::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/egreso');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/egreso');
      }
    }else{ return view('errors/403'); }
    }
}
