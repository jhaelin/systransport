<?php

namespace App;
use DB; 
use Illuminate\Database\Eloquent\Model;

class ModelAdminFleteCamion extends Model
{ 
    protected $table = 'tab_admin_flete_camion';
    protected $fillable = ['title','post'];

    public static function flete(){  
	    return DB::table('tab_admin_flete_camion')
		->join ('tab_conductor','tab_admin_flete_camion.id_conductor', '=', 'tab_conductor.id_conductor')
		->join ('tab_cliente','tab_admin_flete_camion.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_camion','tab_admin_flete_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_admin_flete_camion.id_ruta', '=', 'tab_ruta.id_ruta')
	    ->select('*')
	    //->where('estado_flete','HABILITADO')
	    ->orderBy('fecha_flete','DESC') 
	    ->get();
	}  
 
	public static function vflete(){ 
		return DB::table('tab_admin_flete_camion')
		->join ('tab_ingreso','tab_admin_flete_camion.id_flete_camion', '=', 'tab_ingreso.id_flete_camion')
	    ->select('tab_ingreso.id_flete_camion')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_admin_flete_camion')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_admin_flete_camion')
		->join ('tab_conductor','tab_admin_flete_camion.id_conductor', '=', 'tab_conductor.id_conductor')
		->join ('tab_cliente','tab_admin_flete_camion.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_camion','tab_admin_flete_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_admin_flete_camion.id_ruta', '=', 'tab_ruta.id_ruta')
	    //->where('estado_flete', 'HABILITADO')
	    ->where('tab_admin_flete_camion.id_flete_camion', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_admin_flete_camion')
	    ->where ('id_flete_camion', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_admin_flete_camion')
	    ->where ('id_flete_camion',$id)
	    ->delete();
    }

    public static function delet_($id){
    	//var_dump($id);exit();
	    $row = array('estado_flete' => 'DESHABILITADO');
	    return $i= \DB::table('tab_admin_flete_camion')
	    ->where ('id_flete_camion',$id)
	    ->update($row);
    }

    public static function delet_e($id){
    	//var_dump($id);exit();
	    $row = array('estado_flete' => 'HABILITADO');
	    return $i= \DB::table('tab_admin_flete_camion')
	    ->where ('id_flete_camion',$id)
	    ->update($row);
    }
    public static function max(){
	    return $i= \DB::table('tab_admin_flete_camion')->max('id_flete_camion');
    }
    public static function delete_e($id_camion){

        $max = ModelAdminFleteCamion::max();
	    $row = array('estado_flete' => 'DESHABILITADO');
	    return $i= \DB::table('tab_admin_flete_camion')
	    ->where ('id_flete_camion','!=',$max)
	    ->where ('id_camion',$id_camion)
	    ->update($row);
    }

    public static function reporteFlete1($val2){ 
	    return DB::table('tab_admin_flete_camion')
		->join ('tab_conductor','tab_admin_flete_camion.id_conductor', '=', 'tab_conductor.id_conductor')
		->join ('tab_cliente','tab_admin_flete_camion.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_camion','tab_admin_flete_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_admin_flete_camion.id_ruta', '=', 'tab_ruta.id_ruta')
	    ->select('*')
	    ->where('estado_flete',$val2)
	    ->orderBy('fecha_flete','DESC') 
	    ->get();
	}

    public static function reporteFlete2($val,$val1){ 
	    return DB::table('tab_admin_flete_camion')
		->join ('tab_conductor','tab_admin_flete_camion.id_conductor', '=', 'tab_conductor.id_conductor')
		->join ('tab_cliente','tab_admin_flete_camion.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_camion','tab_admin_flete_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_admin_flete_camion.id_ruta', '=', 'tab_ruta.id_ruta')
	    ->select('*')
	    ->whereBetween('tab_admin_flete_camion.fecha_flete', ["$val", "$val1"])
	    ->orderBy('fecha_flete','DESC') 
	    ->get();
	}

    public static function reporteFlete3($val,$val1,$val2){ 
	    return DB::table('tab_admin_flete_camion')
		->join ('tab_conductor','tab_admin_flete_camion.id_conductor', '=', 'tab_conductor.id_conductor')
		->join ('tab_cliente','tab_admin_flete_camion.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_camion','tab_admin_flete_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_admin_flete_camion.id_ruta', '=', 'tab_ruta.id_ruta')
	    ->select('*')
	    ->where('estado_flete',$val2)
	    ->whereBetween('tab_admin_flete_camion.fecha_flete', ["$val", "$val1"])
	    ->orderBy('fecha_flete','DESC') 
	    ->get();
	}
}
