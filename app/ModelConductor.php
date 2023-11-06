<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
 
class ModelConductor extends Model
{
	protected $table = 'tab_conductor';
    protected $fillable = ['title','post'];

    public static function conductor(){ 
	    return DB::table('tab_conductor')
	    ->select('*')
	    ->where('estado_con','A')
	    ->orderBy('nombre_con','DESC') 
	    ->get();
	}  
 
	public static function vconductor(){ 
		return DB::table('tab_conductor')
		->join ('tab_admin_flete_camion','tab_conductor.id_conductor', '=', 'tab_admin_flete_camion.id_conductor')
	    ->select('tab_conductor.id_conductor')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_conductor')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_conductor')
	    ->where('estado_con', 'A')
	    ->where('id_conductor', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_conductor')
	    ->where ('id_conductor', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_conductor')
	    ->where ('id_conductor',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado_con' => 'I');
	    return $i= \DB::table('tab_conductor')
	    ->where ('id_conductor',$id)
	    ->update($row);
    }


	public static function reporteConductor($val){ 
	    return DB::table('tab_conductor')
	    ->select('*')
	    ->where('tab_conductor.id_conductor',$val)
	    ->get();
	}
}