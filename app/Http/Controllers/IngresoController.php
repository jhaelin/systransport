<?php 
 
namespace App\Http\Controllers; 
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelIngreso; 
use App\ModelCliente;
use App\ModelCamion;
use App\ModelRuta;
use App\ModelEmpresa;
use App\ModelAdminFleteCamion;
use Session;

class IngresoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');  
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('ingreso.ViewIndex')->with('data',ModelIngreso::ingreso())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){
            return view('ingreso.ViewNew')->with('e',ModelEmpresa::emp())->with('camIng',ModelCamion::camIng())
            ->with('cliente',ModelCliente::cliente())->with('camion',ModelCamion::camionFlete())->with('ruta',ModelRuta::ruta());
        }else{ return view('errors.403'); }
    }

    public function ingresoFlete3js(Request $request){ 
      $post=$request->all();$dato='';$id=0;
      if($post!=''){
                 $val=$post['val'];
                 $data=ModelCamion::ingresoFlete($val);
                 foreach ($data as $row) {$id=$row->id_flete_camion; }
                  $dato=$dato.'<input type="hidden" name="id_flete" value="'.$id.'">';     
                 return $dato; 
      }
    }
    public function ingresoFletejs(Request $request){ 
      $post=$request->all();$dato='';
      if($post!=''){
                 $val=$post['val'];
                 $data=ModelCamion::ingresoFlete($val);
                 foreach ($data as $row) { $dato=$dato.'<option value="'.$row->id_cliente.'">NIT: '.$row->nit.' '.$row->razon_social.'</option>'; }     
                 return $dato; 
      }
    }

    public function ingresoFlete2js(Request $request){ 
      $post=$request->all();$dato='';
      if($post!=''){
                 $val=$post['val'];
                 $data=ModelCamion::ingresoFlete($val);
                 foreach ($data as $row) { $dato=$dato.'<option value="'.$row->id_ruta.'">'.$row->nombre_ruta.' Km: '.$row->distancia_km.'</option>'; }     
                 return $dato; 
      }
    }

    public function store(Request $request){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $post=$request->all(); 
        //var_dump($post);exit();
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
            'fecha'=>'required|date',
            'codigo'=>'required',
            'transportadora'=>'required',
            'camion'=>'required|integer',
            'cliente'=>'required',
            'cantidad'=>'required',
            'unidad'=>'required',
            'total'=>'required',
            'ruta'=>'required|integer',
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 
            $idFlete=$post['id_flete'];
            $data = array( 
              'nro_transporte'=>strtoupper($post['transporte']),
              'fecha_ing'=>$post['fecha'],
              'codigo_ing'=>strtoupper($post['codigo']),
              'nro_hoja_entrada'=>$post['hoja_entrada'],
              'doc_compra' =>$post['doc_compra'],
              'transportadora_empresa' =>$post['transportadora'],
              'id_camion'=>$post['camion'],
              'nro_gasto'=>$post['gasto'],
              'hoja_trabajo' =>$post['hoja_trabajo'],
              'id_cliente' =>$post['cliente'],
              'tonelada_tn'=>$post['cantidad'],
              'precio_unidad'=>$post['unidad'],
              'total_costo_flete' =>$post['total'],
              'id_ruta' =>$post['ruta'],
              'id_flete_camion' =>$idFlete,
              'nro_entrega'=>$post['num_entrega'],
              'nro_material_mercaderia'=>$post['num_matrial'],
              'observacion' =>mb_strtoupper($post['observacion'])
              );
            $resul = ModelIngreso::store($data);
            //$resul2 = ModelAdminFleteCamion::delet_($idFlete);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/ingreso');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/ingreso');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function show($id){}

    public function edit($id){
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){ 
            $row = ModelIngreso::edit($id);

            $cliente=ModelCliente::cliente();
            $camion=ModelCamion::camionFlete();
            $ruta=ModelRuta::ruta();
            $e=ModelEmpresa::emp();
            //var_dump($row);exit();
            if(count($row) > 0){ 
              return view('ingreso.ViewEdit', compact('row','id','e','camion','ruta','cliente'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function update(Request $request, $id){
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $usuario = Auth::user()->id;
        $post=$request->all(); 
        //var_dump($post);exit();
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(), 
                [ 
                  'fecha'=>'required|date',
                  'codigo'=>'required',
                  'transportadora'=>'required',
                  'camion'=>'required|integer',
                  'cliente'=>'required',
                  'cantidad'=>'required',
                  'unidad'=>'required',
                  'total'=>'required',
                  'ruta'=>'required|integer',
                ]); 
          if($v->fails()){return redirect()->back()->withErrors($v->errors());}
          else{
                $data = array( 
                  'nro_transporte'=>strtoupper($post['transporte']),
                  'fecha_ing'=>$post['fecha'],
                  'codigo_ing'=>strtoupper($post['codigo']),
                  'nro_hoja_entrada'=>$post['hoja_entrada'],
                  'doc_compra' =>$post['doc_compra'],
                  //'transportadora_empresa' =>$post['transportadora'],
                  'id_camion'=>$post['camion'],
                  'nro_gasto'=>$post['gasto'],
                  'hoja_trabajo' =>$post['hoja_trabajo'],
                  //'id_cliente' =>$post['cliente'],
                  'tonelada_tn'=>$post['cantidad'],
                  'precio_unidad'=>$post['unidad'],
                  'total_costo_flete' =>$post['total'],
                  'id_flete_camion' =>$post['id_flete'],
                  'id_ruta' =>$post['ruta'],
                  'nro_entrega'=>$post['num_entrega'],
                  'nro_material_mercaderia'=>$post['num_matrial'],
                  'observacion' =>mb_strtoupper($post['observacion'])
                  );
            $resul = ModelIngreso::updat($data,$id);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue Modificado exitosamente ...!!!');
            return redirect('/ingreso');
          }else{
            \Session::flash('message','Registro no fue Modificado');
            return redirect('/ingreso');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    protected function delete($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2){
        $row = ModelIngreso::edit($id);
        if(count($row)){
         return view('ingreso.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];$idFlete=$post['id_flete'];
       $resul = ModelIngreso::delet($id);
       $resul2 = ModelAdminFleteCamion::delet_e($idFlete);
       if($resul > 0 && $resul2 > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/ingreso');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/ingreso');
      }
    }else{ return view('errors/403'); }
    }
}
