<?php
namespace App;  

use DB;
use Illuminate\Database\Eloquent\Model; 

class ModelAsigPersona extends Model
{
	protected $table = 'tab_asignacion_persona';
    protected $fillable = ['title','post'];

    public static function asigperson(){ 
	    return DB::table('tab_asignacion_persona')
	    ->join ('tab_persona','tab_asignacion_persona.id_persona', '=', 'tab_persona.id_persona')
	    ->join ('tab_cargo','tab_asignacion_persona.id_cargo', '=', 'tab_cargo.id_cargo')
	    ->select('*')
	    ->where('estado_asignacion','A' )
	    ->orderBy('nombre','DESC')
	    ->get();
	}  
	public static function vvasigperson(){ 
		return DB::table('tab_asignacion_persona')
		->join ('tab_usuario','tab_asignacion_persona.id_asignacion_persona', '=', 'tab_usuario.id_asignacion_persona')
	    ->select('tab_asignacion_persona.id_asignacion_persona')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_asignacion_persona')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_asignacion_persona')
	    ->join ('tab_persona','tab_asignacion_persona.id_persona', '=', 'tab_persona.id_persona')
	    ->join ('tab_cargo','tab_asignacion_persona.id_cargo', '=', 'tab_cargo.id_cargo')
	    ->where('estado_asignacion', 'A')
	    ->where('id_asignacion_persona', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_asignacion_persona')
	    ->where ('id_asignacion_persona', $id)
	    ->update($row); 
    }

    public static function delet_($id){
	    $row = array('estado_asignacion' => 'I');
	    return $i= \DB::table('tab_asignacion_persona')
	    ->where ('id_asignacion_persona',$id)
	    ->update($row);
    }

    public static function delet($id){
	    return $i= \DB::table('tab_asignacion_persona')
	    ->where ('id_asignacion_persona',$id)
	    ->delete();
    }

    public static function gestion(){ 
	    return DB::table('tab_gestion')
	    ->orderBy('gestion','asc')
	    ->get();
	} 
}
