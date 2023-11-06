<?php 

namespace App\Http\Controllers;
use Auth; 
use Crypt;
use Illuminate\Http\Request;
use App\ModelPersona; 
use App\ModelEmpresa;
use Storage;
use Session;

class PersonaController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function index(){
        $rol = Auth::user()->id_rol;
        if($rol>=1 && $rol<=4){
        return view('persona.ViewIndex')->with('data',ModelPersona::persona())->with('vf',ModelPersona::vpersona())->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function create(){        
        $rol = Auth::user()->id_rol;
        if($rol==1){
            return view('persona.ViewNew')->with('e',ModelEmpresa::emp());
        }else{ return view('errors.403'); }
    }

    public function store(Request $request){          
        $rol = Auth::user()->id_rol;
        if($rol==1){    
            $dato=new ModelPersona();
            $dato->nombre=mb_strtoupper($request->nombre);
            $dato->paterno=mb_strtoupper($request->paterno);
            $dato->materno=mb_strtoupper($request->materno);
            $dato->ci=$request->ci;
            $dato->expedido=$request->exp;
            $dato->zona=mb_strtoupper($request->zona);
            $dato->calle=mb_strtoupper($request->calle);
            $dato->numero=$request->num;
            $dato->telefono=$request->tel;
            $dato->celular=$request->cel;
            $dato->email=strtolower($request->email);
            $dato->cargo=mb_strtoupper($request->cargo);

            if($request->archivo=='') {
              $archivo='';
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
            $dato->foto=$archivo;
            $dato->ruta='public/uploads_files/'.$archivo;
            $dato->tipo=$archivo_tipo;
            $dato->tamanio=$archivo_tamanio;
            if($dato->save()){
              Session::flash('msg','CORRECTO');
              \Session::flash('message','Registro fue guardado exitosamente ...!!!');
              return redirect('/persona');
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
        if($rol==1){ 
            $row = ModelPersona::edit($id);
            $e=ModelEmpresa::emp();
            if(count($row) > 0){ 
              return view('persona.ViewEdit', compact('row','id','e'));
            }else{return view('errors/404');}
        }else{ return view('errors.403'); }
    }

    public function update(Request $request, $id){        
        $rol = Auth::user()->id_rol;
        if($rol==1){ 
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
                          'nombre'  =>mb_strtoupper($post['nombre']),
                          'paterno' =>mb_strtoupper($post['paterno']),
                          'materno' =>mb_strtoupper($post['materno']),
                          'ci'      =>$post['ci'],
                          'expedido'=>$post['exp'],
                          'zona'    =>mb_strtoupper($post['zona']),
                          'calle'   =>mb_strtoupper($post['calle']),
                          'numero'  =>$post['num'],
                          'telefono'=>$post['tel'],
                          'celular' =>$post['cel'],
                          'email'   =>strtolower($post['email']),
                          'cargo'   =>mb_strtoupper($post['cargo']),

                          'foto'    =>$archivo,
                          'ruta'    =>'public/uploads_files/'.$archivo,
                          'tipo'    =>$archivo_tipo,
                          'tamanio' =>$archivo_tamanio
                          );
                }
                else{
                        $data = array( 
                          'nombre'  =>mb_strtoupper($post['nombre']),
                          'paterno' =>mb_strtoupper($post['paterno']),
                          'materno' =>mb_strtoupper($post['materno']),
                          'ci'      =>$post['ci'],
                          'expedido'=>$post['exp'],
                          'zona'    =>mb_strtoupper($post['zona']),
                          'calle'   =>mb_strtoupper($post['calle']),
                          'numero'  =>$post['num'],
                          'telefono'=>$post['tel'],
                          'celular' =>$post['cel'],
                          'email'   =>strtolower($post['email']),
                          'cargo'   =>mb_strtoupper($post['cargo']),
                          );
                }
            $resul = ModelPersona::updat($data,$id);
            if($resul>0)
            {
              Session::flash('msg','CORRECTO');
             \Session::flash('message','Registro fue modificado exitosamente ...!!!');
              return redirect('/persona');
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
      if( $rol==1){
        $row = ModelPersona::edit($id);
        if(count($row)){
         return view('persona.ViewDelete')->with('row', $row)->with('e',ModelEmpresa::emp());
       }else{ return view('errors/404'); }
     }else{ return view('errors/403'); }
    }


    public function delet(Request $request){
     $rol = Auth::user()->id_rol;
     if( $rol==1){
        $post=$request->all(); 
        $id=$post['id'];
       $resul = ModelPersona::delet($id);
       if($resul > 0){
        \Session::flash('message','Registro fue Elimado exitosamente ...!!!');
        return redirect('/persona');
      }else{
        \Session::flash('message','Registro no fue Eliminado');
        return redirect('/persona');
      }
    }else{ return view('errors/403'); }
    }
}
