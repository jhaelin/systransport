<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ModelRuta extends Model
{
    protected $table = 'tab_ruta';
    protected $fillable = ['title','post'];

    public static function ruta(){ 
	    return DB::table('tab_ruta')
	    ->select('*')
	    ->where('estado_ruta','A' )
	    ->orderBy('nombre_ruta','DESC')
	    ->get();
	}  

	public static function vruta(){ 
		return DB::table('tab_ruta')
		->join ('tab_admin_flete_camion','tab_ruta.id_ruta', '=', 'tab_admin_flete_camion.id_ruta')
	    ->select('tab_ruta.id_ruta')
	    ->get();
	}  

    public static function store($data){
	    return DB::table('tab_ruta')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_ruta')
	    ->where('estado_ruta', 'A')
	    ->where('id_ruta', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_ruta')
	    ->where ('id_ruta', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    $row = array('estado_ruta' => 'I');
	    return $i= \DB::table('tab_ruta')
	    ->where ('id_ruta',$id)
	    ->update($row);
    }
}
