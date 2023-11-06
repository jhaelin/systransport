<?php
namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelCliente;  
use App\ModelEmpresa;
use Storage;
use Session;

class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('cliente.ViewIndex')->with('data',ModelCliente::cliente())->with('vf',ModelCliente::vcliente())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){
            return view('cliente.ViewNew')->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){          
        $rol = Auth::user()->id_rol;
        if($rol==1 || $rol==2){    
            $dato=new ModelCliente();
            $dato->nit=mb_strtoupper($request->nit);
            $dato->razon_social=mb_strtoupper($request->razon);
            $dato->nro_autorizacion=mb_strtoupper($request->autorizacion);
            $dato->nombre_representante=mb_strtoupper($request->nombre);
            $dato->ci_representante=$request->ci;
            $dato->expedido_representante=mb_strtoupper($request->exp);
            $dato->ciudad_cli=mb_strtoupper($request->ciudad);
            $dato->zona_cli=mb_strtoupper($request->zona);
            $dato->calle_cli=mb_strtoupper($request->calle);
            $dato->numero_cli=$request->num;
            $dato->telefono_cli=$request->tel;
            $dato->celular_cli=$request->cel;
            $dato->email_cli=strtolower($request->email);
            $dato->web_cli=strtolower($request->web);
            $dato->fax_cli=$request->fax;

            if($request->archivo=='') { 
              $archivo='logo_defecto.jpg';
              $archivo_tipo='public/uploads_files/logo_defecto.jpg';
              $archivo_tamanio='43,1';
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
            $dato->logo_cli=$archivo;
            $dato->ruta_cli='public/uploads_files/'.$archivo;
            $dato->tipo_cli=$archivo_tipo;
            $dato->tamanio_cli=$archivo_tamanio;
            if($dato->save()){
              Session::flash('msg','CORRECTO');
              \Session::flash('message','Registro fue guardado exitosamente ...!!!');
              return redirect('/cliente');
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
            $row = ModelCliente::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('cliente.ViewEdit', compact('row','id','e'));
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
                          'nit'  =>mb_strtoupper($post['nit']),
                          'razon_social' =>mb_strtoupper($post['razon']),
                          'nro_autorizacion' =>mb_strtoupper($post['autorizacion']),
                          'nombre_representante'=>mb_strtoupper($post['nombre']),
                          'ci_representante'=>$post['ci'],
                          'expedido_representante'=>mb_strtoupper($post['exp']),
                          'ciudad_cli'=>mb_strtoupper($post['ciudad']),
                          'zona_cli'    =>mb_strtoupper($post['zona']),
                          'calle_cli'   =>mb_strtoupper($post['calle']),
                          'numero_cli'  =>$post['num'],
                          'telefono_cli'=>$post['tel'],
                          'celular_cli' =>$post['cel'],
                          'email_cli'   =>$post['email'],
                          'web_cli' =>$post['web'],
                          'fax_cli'   =>$post['fax'],

                          'logo_cli'    =>$archivo,
                          'ruta_cli'    =>'public/uploads_files/'.$archivo,
                          'tipo_cli'    =>$archivo_tipo,
                          'tamanio_cli' =>$archivo_tamanio
                          );
                }
                else{
                        $data = array( 
                          'nit'  =>mb_strtoupper($post['nit']),
                          'razon_social' =>mb_strtoupper($post['razon']),
                          'nro_autorizacion' =>mb_strtoupper($post['autorizacion']),
                          'nombre_representante'=>mb_strtoupper($post['nombre']),
                          'ci_representante'=>$post['ci'],
                          'expedido_representante'=>mb_strtoupper($post['exp']),
                          'ciudad_cli'=>mb_strtoupper($post['ciudad']),
                          'zona_cli'    =>mb_strtoupper($post['zona']),
                          'calle_cli'   =>mb_strtoupper($post['calle']),
                          'numero_cli'  =>$post['num'],
                          'telefono_cli'=>$post['tel'],
                          'celular_cli' =>$post['cel'],
                          'email_cli'   =>strtolower($post['email']),
                          'web_cli' =>strtolower($post['web']),
                          'fax_cli'   =>$post['fax'],
                          );
                }
            $resul = ModelCliente::updat($data,$id);
            if($resul>0)
            {
              Session::flash('msg','CORRECTO');
             \Session::flash('message','Registro fue modificado exitosamente ...!!!');
              return redirect('/cliente');
            }
            else
            {
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
        $row = ModelCliente::edit($id);
        if(count($row)){
         return view('cliente.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if($rol==1 || $rol==2){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelCliente::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/cliente');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/cliente');
      }
    }else{ return view('errors/403'); }
    }
}
