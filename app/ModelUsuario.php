<?php
namespace App; 
 
use DB;
use Illuminate\Database\Eloquent\Model;
 
class ModelUsuario extends Model
{
    protected $fillable = ['title','post'];

    public static function usuario(){ 
	    return DB::table('tab_usuario')
	    ->join('tab_persona', 'tab_usuario.id_persona','=','tab_persona.id_persona')
	    ->select('tab_usuario.id','tab_usuario.id_persona', 'tab_usuario.id_rol','tab_usuario.email','tab_usuario.name','tab_usuario.codigo_usuario',
	    	     'tab_usuario.tipo_usuario','tab_usuario.estado_','tab_usuario.foto_', 'tab_usuario.ruta_',
	    	     'tab_persona.ci', 'tab_persona.expedido', 'tab_persona.nombre', 'tab_persona.paterno', 'tab_persona.materno','tab_persona.zona', 'tab_persona.calle',
	    	     'tab_persona.numero', 'tab_persona.email as email_', 'tab_persona.telefono', 'tab_persona.celular',
	    	     'tab_persona.cargo','tab_usuario.estado_usuario')
	    //->where('tab_usuario.tipo_usuario','!=','MAESTRO')
	    ->where('tab_persona.id_persona','!=',1)
	    ->orderBy('tab_usuario.cod','DESC')
	    ->get();
	}

    public static function max(){ 
	    return DB::table('tab_usuario')->max('cod'); 
	}
	
	public static function valpersonusuario(){
	    return $row = \DB::table('tab_usuario')
	    ->join('tab_persona', 'tab_usuario.id_persona','=','tab_persona.id_persona')
	    ->select('tab_usuario.id_persona')
	    ->get();
    }
	public static function valpersonjq($val){
	    return $row = \DB::table('tab_usuario')
	    ->select('*')
	    ->where('id_persona',$val )
	    ->get();
    }

	public static function valcuentajq($val){
	    return $row = \DB::table('tab_usuario')
	    ->select('*')
	    ->where('email',$val )
	    ->get();
    }

    public static function store($data){
	    return DB::table('tab_usuario')->insert($data);
	} 

	public static function actpassw($id){
	    return $row = \DB::table('tab_usuario')
	    ->select('password')
	    ->where('id',$id)
	    ->first();
    }
    public static function edit($id){ 
	    return DB::table('tab_usuario')
	    ->join('tab_persona', 'tab_usuario.id_persona','=','tab_persona.id_persona')
	    ->select('tab_usuario.id','tab_usuario.id_persona', 'tab_usuario.id_rol','tab_usuario.email','tab_usuario.name','tab_usuario.codigo_usuario',
	    	     'tab_usuario.tipo_usuario','tab_usuario.estado_','tab_usuario.foto_', 'tab_usuario.ruta_',
	    	     'tab_persona.ci', 'tab_persona.expedido', 'tab_persona.nombre', 'tab_persona.paterno', 'tab_persona.materno','tab_persona.zona', 'tab_persona.calle',
	    	     'tab_persona.numero', 'tab_persona.email as email_', 'tab_persona.telefono', 'tab_persona.celular',
	    	     'tab_persona.cargo','tab_usuario.estado_usuario'
	    	     )
	    ->where('tab_usuario.id',$id )
	    ->first();
	}

    public static function updat($row, $id){
	    return $i= \DB::table('tab_usuario')
	    ->where ('id', $id)
	    ->update($row); 
    }
    public static function delet($id){
    	//var_dump($id);exit();
	    return $i= \DB::table('tab_usuario')
	    ->where ('id',$id)
	    ->delete();
    }
    public static function delet_($id){
    	//var_dump($id);exit();
	    $row = array('estado_' => '0');
	    return $i= \DB::table('tab_usuario')
	    ->where ('id',$id)
	    ->update($row);
    }


	public static function editk($id){
	    return $row = \DB::table('tab_area')
	    ->where('estado_area', 'A')
	    ->where('id_area', $id)
	    ->select('*')
	    ->first();
    }



    //reporte
    public static function tipo(){ 
	    return DB::table('tab_usuario')
	     ->select('tipo_usuario')
	     ->distinct('tipo_usuario')
	     ->get();
	}  
	public static function ustipo($val){ 
	    return DB::table('tab_usuario')
	    ->join('tab_persona', 'tab_usuario.id_persona','=','tab_persona.id_persona')
	    ->select('*')
	    ->where('tab_usuario.tipo_usuario',$val)
	    ->get();
	}  
}