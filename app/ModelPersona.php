<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
 
class ModelPersona extends Model
{
	protected $table = 'tab_persona';
    protected $fillable = ['title','post'];

    public static function persona(){ 
	    return DB::table('tab_persona')
	    ->select('*')
	    ->where('estado','A')
	    ->where('id_persona','!=',1)
	    ->orderBy('nombre','DESC') 
	    ->get();
	}  
 
	public static function vpersona(){ 
		return DB::table('tab_persona')
		->join ('tab_usuario','tab_persona.id_persona', '=', 'tab_usuario.id_persona')
	    ->select('tab_persona.id_persona')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_persona')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_persona')
	    ->where('estado', 'A')
	    ->where('id_persona', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_persona')
	    ->where ('id_persona', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_persona')
	    ->where ('id_persona',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado' => 'I');
	    return $i= \DB::table('tab_persona')
	    ->where ('id_persona',$id)
	    ->update($row);
    }

    public static function personausurio(){ 
	    return DB::table('tab_persona')
	    ->join ('tab_usuario', 'tab_persona.id_persona','=','tab_usuario.id_persona')
	    ->select('*')
	    ->where('estado','A')
	    ->orderBy('nombre','asc') 
	    ->get();
	} 
}