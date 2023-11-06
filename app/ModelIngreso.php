<?php
namespace App;   
use DB;
use Illuminate\Database\Eloquent\Model; 
 
class ModelIngreso extends Model
{
	protected $table = 'tab_ingreso';
    protected $fillable = ['title','post'];

    public static function ingreso(){ 
	    return DB::table('tab_ingreso')
		->join ('tab_camion','tab_ingreso.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_ingreso.id_ruta', '=', 'tab_ruta.id_ruta')
		->join ('tab_cliente','tab_ingreso.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_empresa','tab_ingreso.transportadora_empresa', '=', 'tab_empresa.id_empresa')
	    ->select('*')
	    ->where('estado_i','A')
	    ->orderBy('fecha_ing','DESC') 
	    ->get();
	}  
 
	public static function vingreso(){ 
		return DB::table('tab_ingreso')
		->join ('tab_admin_flete_camion','tab_ingreso.id_ingreso', '=', 'tab_admin_flete_camion.id_ingreso')
	    ->select('tab_ingreso.id_ingreso')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_ingreso')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_ingreso')
		->join ('tab_camion','tab_ingreso.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_ingreso.id_ruta', '=', 'tab_ruta.id_ruta')
		->join ('tab_cliente','tab_ingreso.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_empresa','tab_ingreso.transportadora_empresa', '=', 'tab_empresa.id_empresa')
	    ->where('estado_i', 'A')
	    ->where('id_ingreso', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_ingreso')
	    ->where ('id_ingreso', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_ingreso')
	    ->where ('id_ingreso',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado_e' => 'I');
	    return $i= \DB::table('tab_ingreso')
	    ->where ('id_ingreso',$id)
	    ->update($row);
    }

    public static function reporteIngreso1($val2){ 
	    return DB::table('tab_ingreso')
		->join ('tab_camion','tab_ingreso.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_ingreso.id_ruta', '=', 'tab_ruta.id_ruta')
		->join ('tab_cliente','tab_ingreso.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_empresa','tab_ingreso.transportadora_empresa', '=', 'tab_empresa.id_empresa')
	    ->select('*')
	    ->where('estado_i','A')
	    ->where('tab_cliente.id_cliente', $val2)
	    ->orderBy('fecha_ing','DESC') 
	    ->get();
	} 

    public static function reporteIngreso2($val,$val1){ 
	    return DB::table('tab_ingreso')
		->join ('tab_camion','tab_ingreso.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_ingreso.id_ruta', '=', 'tab_ruta.id_ruta')
		->join ('tab_cliente','tab_ingreso.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_empresa','tab_ingreso.transportadora_empresa', '=', 'tab_empresa.id_empresa')
	    ->select('*')
	    ->where('tab_ingreso.estado_i','A')
	    ->whereBetween('tab_ingreso.fecha_ing', ["$val", "$val1"])
	    ->orderBy('tab_ingreso.fecha_ing','DESC') 
	    ->get();
	} 

    public static function reporteIngreso3($val,$val1,$val2){ 
	    return DB::table('tab_ingreso')
		->join ('tab_camion','tab_ingreso.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_ruta','tab_ingreso.id_ruta', '=', 'tab_ruta.id_ruta')
		->join ('tab_cliente','tab_ingreso.id_cliente', '=', 'tab_cliente.id_cliente')
		->join ('tab_empresa','tab_ingreso.transportadora_empresa', '=', 'tab_empresa.id_empresa')
	    ->select('*')
	    ->where('tab_ingreso.estado_i','A')
	    ->where('tab_cliente.id_cliente', $val2)
	    ->whereBetween('tab_ingreso.fecha_ing', ["$val", "$val1"])
	    ->orderBy('tab_ingreso.fecha_ing','DESC') 
	    ->get();
	} 


    public static function impIngreso(){
		$resultado = DB::select("SELECT SUM(tab_ingreso.total_costo_flete) as total_ingreso 
			                     FROM tab_ingreso WHERE tab_ingreso.estado_i='A'");
        return $resultado; 
	}    

	public static function impIngreso1($val, $val1){
		$resultado = DB::select("SELECT SUM(tab_ingreso.total_costo_flete) as total_ingreso 
			                     FROM tab_ingreso 
			                     WHERE tab_ingreso.estado_i='A'
			                     AND tab_ingreso.fecha_ing>='$val'
		                         AND tab_ingreso.fecha_ing<='$val1'");
        return $resultado; 
	}

	public static function fechaMin(){ 
	    return DB::table('tab_ingreso')
	    ->Min('fecha_ing');
	}

	public static function fechaMax(){ 
	    return DB::table('tab_ingreso')
	    ->Max('fecha_ing');
	}  
}