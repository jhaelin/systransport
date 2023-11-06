<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
 
class ModelCamion extends Model
{
	protected $table = 'tab_camion';
    protected $fillable = ['title','post'];

    public static function camion(){ 
	    return DB::table('tab_camion')
	    ->select('*')
	    ->where('estado_cam','A')
	    ->orderBy('marca','DESC') 
	    ->orderBy('modelo','DESC') 
	    ->get();
	}  
     public static function camIng(){ 
	    return DB::table('tab_camion')
	    ->join ('tab_ingreso','tab_camion.id_camion', '=', 'tab_ingreso.id_camion')
	    ->select('tab_camion.id_camion')
	    ->where('estado_cam','A')
	    ->get();
	} 
 //    public static function camionFlete(){ 
	//     return DB::table('tab_camion')
	// 	->join ('tab_admin_flete_camion','tab_camion.id_camion', '=', 'tab_admin_flete_camion.id_camion')
	//     ->select('*')
	//     ->where('estado_cam','A')
	//     ->where('estado_flete','HABILITADO')
	//     ->orderBy('marca','DESC') 
	//     ->orderBy('modelo','DESC')
	//     ->get();
	// }   	
	public static function camionFlete(){
		$resultado = DB::select("SELECT tab_camion.matricula, tab_camion.marca, tab_camion.modelo, tab_camion.id_camion, T1.estado_flete, T1.id_flete_camion
								FROM tab_admin_flete_camion T1 
								INNER JOIN tab_cliente ON(T1.id_cliente=tab_cliente.id_cliente)
								INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
								INNER JOIN tab_ruta ON(T1.id_ruta=tab_ruta.id_ruta)
								INNER JOIN (SELECT tab_admin_flete_camion.id_camion, MAX(tab_admin_flete_camion.id_flete_camion) AS max_id , tab_admin_flete_camion.id_cliente
											FROM tab_admin_flete_camion 
											GROUP BY tab_admin_flete_camion.id_camion) T2 ON T1.id_camion = T2.id_camion 
											AND T1.id_flete_camion = T2.max_id
								            WHERE T1.estado_flete='HABILITADO'");
        return $resultado; 
	} 

 	public static function ingresoFlete($val){
		$resultado = DB::select("SELECT tab_cliente.id_cliente,tab_cliente.nit,tab_cliente.razon_social,tab_ruta.id_ruta,tab_ruta.nombre_ruta,tab_ruta.distancia_km, T1.id_flete_camion
								FROM tab_admin_flete_camion T1 
								INNER JOIN tab_cliente ON(T1.id_cliente=tab_cliente.id_cliente)
								INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
								INNER JOIN tab_ruta ON(T1.id_ruta=tab_ruta.id_ruta)
								INNER JOIN (SELECT tab_admin_flete_camion.id_camion, MAX(tab_admin_flete_camion.id_flete_camion) AS max_id , tab_admin_flete_camion.id_cliente
											FROM tab_admin_flete_camion 
											GROUP BY tab_admin_flete_camion.id_camion) T2 ON T1.id_camion = T2.id_camion 
											AND T1.id_flete_camion = T2.max_id
								            WHERE T1.estado_flete='HABILITADO'
											AND T1.id_camion=$val");
        return $resultado; 
	}
 //    public static function ingresoFlete($val){ 
	//     return DB::table('tab_camion')
	// 	->join ('tab_admin_flete_camion','tab_camion.id_camion', '=', 'tab_admin_flete_camion.id_camion')
	// 	->join ('tab_cliente','tab_admin_flete_camion.id_cliente', '=', 'tab_cliente.id_cliente')
	// 	->join ('tab_ruta','tab_admin_flete_camion.id_ruta', '=', 'tab_ruta.id_ruta')
	//     ->select('tab_cliente.id_cliente','tab_cliente.nit','tab_cliente.razon_social', 'tab_ruta.id_ruta', 'tab_ruta.nombre_ruta' ,'tab_ruta.distancia_km')
	//     ->where('estado_cam','A')
	//     ->where('estado_flete','HABILITADO')
	//     ->where('tab_camion.id_camion',$val)
	//     ->orderBy('marca','DESC') 
	//     ->orderBy('modelo','DESC')
	//     ->get();
	// } 

	public static function vcamion(){ 
		return DB::table('tab_camion')
		->join ('tab_admin_flete_camion','tab_camion.id_camion', '=', 'tab_admin_flete_camion.id_camion')
	    ->select('tab_camion.id_camion')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_camion')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_camion')
	    ->where('estado_cam', 'A')
	    ->where('id_camion', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){ 
	    return $i= \DB::table('tab_camion')
	    ->where ('id_camion', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_camion')
	    ->where ('id_camion',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado_cam' => 'I');
	    return $i= \DB::table('tab_camion')
	    ->where ('id_camion',$id)
	    ->update($row);
    }  

	public static function reporteCamion($val){ 
	    return DB::table('tab_camion')
	    ->select('*')
	    ->where('tab_camion.id_camion',$val)
	    ->get();
	}
}