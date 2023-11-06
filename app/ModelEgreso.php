<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
 
class ModelEgreso extends Model
{
	protected $table = 'tab_egreso';
    protected $fillable = ['title','post'];

    public static function egreso(){ 
	    return DB::table('tab_egreso')
	    ->select('*')
	    ->where('estado_e','A')
	    ->orderBy('fecha_e','DESC') 
	    ->get();
	}  
 
	public static function vegreso(){ 
		return DB::table('tab_egreso')
		->join ('tab_admin_flete_camion','tab_egreso.id_egreso', '=', 'tab_admin_flete_camion.id_egreso')
	    ->select('tab_egreso.id_egreso')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_egreso')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_egreso')
	    ->where('estado_e', 'A')
	    ->where('id_egreso', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_egreso')
	    ->where ('id_egreso', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_egreso')
	    ->where ('id_egreso',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado_e' => 'I');
	    return $i= \DB::table('tab_egreso')
	    ->where ('id_egreso',$id)
	    ->update($row);
    }

    public static function reporteEgreso($val,$val1){ 
	    return DB::table('tab_egreso')
	    ->select('*')
	    ->where('estado_e','A')
	    ->whereBetween('fecha_e', ["$val", "$val1"])
	    ->orderBy('fecha_e','DESC') 
	    ->get();
	} 

    public static function impEgreso(){
		$resultado = DB::select("SELECT SUM(tab_egreso.costo_total) as total_egreso 
			FROM tab_egreso WHERE tab_egreso.estado_e='A'");
        return $resultado; 
	}

    public static function impEgreso1($val, $val1){
		$resultado = DB::select("SELECT SUM(tab_egreso.costo_total) as total_egreso 
			                     FROM tab_egreso 
			                     WHERE tab_egreso.estado_e='A'
			                     AND tab_egreso.fecha_e>='$val'
		                         AND tab_egreso.fecha_e<='$val1'");
        return $resultado; 
	}

	public static function fechaMin(){ 
	    return DB::table('tab_egreso')
	    ->Min('fecha_e');
	} 
	public static function fechaMax(){ 
	    return DB::table('tab_egreso')
	    ->Max('fecha_e');
	} 
}