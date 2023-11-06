<?php
namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Storage;
use Session;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use App\ModelAsigPersona;
use App\ModelPersona;
use App\ModelUsuario;
use App\ModelEmpresa;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }
    public function index(){
        $rol = Auth::user()->id_rol;
        if( $rol==1){
        return view('usuario.ViewIndex')->with('data',ModelUsuario::usuario())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){
        return view('usuario.ViewNew')->with('pers',ModelPersona::persona())
                                      ->with('val',ModelUsuario::valpersonusuario())
                                      ->with('e',ModelEmpresa::emp());
    }

    public function valpersonjq(Request $request){  
      $pers=ModelAsigPersona::asigperson();
      $post=$request->all();$dato='';
      if($post!=''){
        $val=$post['val'];
        $data=ModelUsuario::valpersonjq($val);
        if(count($data)>0){
            // $dato.='<div class="input-group">
            //             <select name="person" id="person" class="form-control show-tick " tabindex="-98" data-live-search="true">
            //                 <option value=""> SELECCIONE PERSONAL </option>';
            //                 foreach($pers as $p){
            //                    $dato.='<option value="'.$p->id_asignacion_persona.'">'.$p->nombre.' '.$p->paterno.' '.$p->materno.'   C.I.:'.$p->ci.' '.$p->expedido.'</option>';
            //                 }
            //             $dato.='</select>                                                
            //         </div>';
            //$dato.='<div class="col-red"><strong>PERSONAL NO HABILITADO</strong></div>';
            $dato='0';
            return $dato;
        }else{
            //$dato.='<div class="col-green"><strong>PERSONAL HABILITADO</strong></div>';
            $dato='1';
            return $dato;            
        }
      }else{}
    }

    public function valcuentajq(Request $request){ 
      $post=$request->all();$dato='';
      if($post!=''){
        $val=$post['val'];
        $data=ModelUsuario::valcuentajq($val);
        if(count($data)>0){
            //$dato.='<p class="col-red">Email no Habilitado</p>';
            $dato='1';
            return $dato;
        }else{
            $dato.='<p class="col-green">Email Habilitado</p>';
            return $dato;            
        }
      }else{}
    }

    public function store(Request $request){
      $rol = Auth::user()->id_rol;
      if( $rol==1){
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(),
            [ 
                'person'=>'required|unique:tab_usuario,id_persona',
                //'email'=>'required|unique:tab_usuario,email',
                'tipo'=>'required'
                //'rol'=>'required'
            ]);
          if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
          }else{ 
            $id=$post['person']; //strtoupper($post['email']),
            $data=ModelPersona::edit($id);
            $max=ModelUsuario::max();
            $resultado = substr($data->nombre, 0, 1);
            $max1=$max+1; $rol=0;
            $pass = $data->ci; 
            $password =hash::make($pass);
            $tipo=$post['tipo'];
            if($tipo=='MAESTRO'){$rol=1;}elseif($tipo=='AUXILIAR'){$rol=2;}
            $codigo_usuario="$rol"."$max1"."$resultado";
            $data = array( 
              'id_persona'=>$id,
              'email'                =>$data->email,
              'tipo_usuario'         =>$tipo,
              'name'                 =>$data->nombre.' '.$data->paterno.' '.$data->materno,
              'codigo_usuario'       =>$codigo_usuario,
              'password'             =>$password,
              'id_rol'               =>$rol,
              'foto_'                =>$data->foto,
              'ruta_'                =>$data->ruta,
              'tipo_'                =>$data->tipo,
              'tamanio_'             =>$data->tamanio,
              'cod'                  =>$max1
              );
            $resul = ModelUsuario::store($data);
          }
          if($resul > 0){
            \Session::flash('message','Registro fue guardado exitosamente ...!!!');
            return redirect('/usuario');
          }else{
            \Session::flash('message','Registro no fue guardado');
            return redirect('/usuario');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function edit($id)
    {  
        $id = Crypt::decrypt($id);
        $rol = Auth::user()->id_rol;
        if($rol==1){ 
            $row = ModelUsuario::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('usuario.ViewEdit', compact('row','id', 'e'));
            }else{return view('errors/404');}
          }
    }

    public function update(Request $request, $id)
    {
          $rol = Auth::user()->id_rol;
          if( $rol==1){
            $usuario = Auth::user()->id;
            $post=$request->all(); 
            if(count($post) > 0 ){
              $v = \Validator::make($request->all(), 
                    [ 
                    //'email'=>'required',
                    'tipo'=>'required'
                    ]);
              if($v->fails()){return redirect()->back()->withErrors($v->errors());}
              else{
                    $tipo=$post['tipo'];
                    if($tipo=='MAESTRO'){$rol=1;}elseif($tipo=='AUXILIAR'){$rol=2;}
                    $data = array( 
                                  //'email'         =>$post['email'],
                                  'tipo_usuario'  =>$tipo,
                                  'id_rol'        =>$rol
                      );
                $resul = ModelUsuario::updat($data,$id);
              }
              if($resul > 0){
                \Session::flash('message','Registro fue Modificado exitosamente ...!!!');
                return redirect('/usuario');
              }else{
                \Session::flash('message','Registro no fue Modificado exitosamente ...!!!');
                return redirect('/usuario');}
            }else{ return view('errors/404'); }
          }else{ return view('errors/403'); }
    }

    protected function deleteU($id,Request $request){
       $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if( $rol==1){
        $row = ModelUsuario::edit($id);
        if(count($row)){
         return view('usuario.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function deletU(Request $request){
     $rol = Auth::user()->id_rol;
     if( $rol==1){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelUsuario::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ..');
        return redirect('/usuario');
      }else{
        \Session::flash('message','Registro no fue Elimnar');
        return redirect('/usuario');
      }
    }else{ return view('errors/403'); }
    }
    public function destroy($id)
    {
        //
    }


    public function show($id){
      $id = Crypt::decrypt($id);
      $rol = Auth::user()->id_rol;
      if($rol==1 || $rol==2 ||$rol==3 || $rol==4){ 
          $row = ModelUsuario::edit($id);
          if(count($row) > 0){ 
            return view('usuario.ViewProfile')->with('row', $row)->with('id', $id)
                  ->with('e',ModelEmpresa::emp());
          }else{return view('errors/404');}
      }else{ return view('errors/403'); }
    }

    public function actpassw(Request $request){ 
      $post=$request->all();$dato=''; 
      if($post!=''){
        $val=$post['val']; 
        if(Hash::check($val, Auth::user()->password)){
            $dato.='1';
            return $dato; 
        }else{
            $dato.='<p class="col-red">contraseña no coincide</p>';
            return $dato; 
        }
      }else{}
    }
   
   public function UpdatePass(Request $request){
      $rol = Auth::user()->id_rol;
      if( $rol==1 || $rol==2 ||$rol==3 || $rol==4){
        $id = Auth::user()->id;
        $post=$request->all(); 
        if(count($post) > 0 ){
          $v = \Validator::make($request->all(), 
                ['p_nuevo'=>'required']);
          if($v->fails()){return redirect()->back()->withErrors($v->errors());}
          else{
                $password =hash::make($post['p_nuevo']);
                $data = array( 'password'=>$password);
                $resul = ModelUsuario::updat($data,$id);
          }
          if($resul > 0){
            //\Session::flash('message','Registro fue Modificado exitosamente ...!!!');
            //Sentry::logout();
            //return Redirect::route('/');
            return redirect('/');
          }else{
            //\Session::flash('message','Registro no fue Modificado exitosamente ...!!!');
            return redirect('/home');}
        }else{ return view('errors/404'); }
      }else{ return view('errors/403'); }
    }

    public function UpdateFoto(Request $request){        
        $rol = Auth::user()->id_rol;
        $id = Auth::user()->id;
        if($rol==1 || $rol==2 || $rol==3){ 
            $post=$request->all(); 
            if($request->file('archivo')){
                if ($request->archivo=='') {
                    $archivo=$request->archivo_2;
                    $archivo_tipo='';
                    $archivo_tamanio='';
                }
                elseif ($request->archivo!='') {
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
                          'foto_'    =>$archivo,
                          'ruta_'    =>'public/uploads_files/'.$archivo,
                          'tipo_'    =>$archivo_tipo,
                          'tamanio_' =>$archivo_tamanio
                          );
                }
            $resul = ModelUsuario::updat($data,$id);
            if($resul>0)
            {
              Session::flash('msg','CORRECTO');
             \Session::flash('message','Registro fue modificado exitosamente ...!!!');
              return redirect('/home');
            }
            else
            {
              Session::flash('msg','ERROR');
              \Session::flash('message','Registro no fue modificado');
              return back();
            }
      }else{ return view('errors.403'); }
    }
}
