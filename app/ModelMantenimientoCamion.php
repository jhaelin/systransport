<?php
 
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model; 

class ModelMantenimientoCamion extends Model
{
    protected $table = 'tab_mantenimiento_camion';
    protected $fillable = ['title','post'];

    public static function mantenimiento(){ 
	    return DB::table('tab_camion')
		->join ('tab_mantenimiento_camion','tab_camion.id_camion', '=', 'tab_mantenimiento_camion.id_camion','left outer')
	    ->select('tab_mantenimiento_camion.id_mantenimiento_camion', 'tab_mantenimiento_camion.id_camion as id_camion_mant',
	    'tab_camion.matricula','tab_camion.modelo','tab_camion.marca','tab_camion.descripcion_cam','tab_camion.tipo_vehiculo',
	    'tab_camion.foto_cam','tab_camion.fecha_registro','tab_camion.id_camion')
	    ->where('estado_cam','A')	    
	    ->groupBy('tab_camion.id_camion')	    
	    ->orderBy('tab_camion.matricula','ASC')
	    ->get();
	} 

    public static function manteni(){ 
	    return DB::table('tab_mantenimiento')
	    ->select('*')
	    ->orderBy('id_mantenimiento','ASC') 
	    ->get();
	}  
 
	public static function vmantenimiento(){ 
		return DB::table('tab_mantenimiento_camion')
		->join ('tab_ingreso','tab_mantenimiento_camion.id_ruta', '=', 'tab_ingreso.id_ruta')
	    ->select('tab_ingreso.id_ruta')
	    ->get();
	}
 
    public static function store($request){
      $store = false;
      $post=$request->all();
      $lista = $post['dato'];
      for ($x = 0; $x < count($lista);$x++) {
        $index = $lista[$x];
        $row = array(  
         'id_camion'  => $post['id_camion'],
         'id_mantenimiento' => $post['id_mantenimiento_'.$index],
         'observacion' => mb_strtoupper($post['observacion_'.$index]),
         'fecha_man' => $post['fecha_man_'.$index],
         'fecha_prox_revision' => $post['fecha_prox_'.$index]
         );
        $item= \DB::table('tab_mantenimiento_camion')->insert($row);
        $store = $item > 0?true:$store;
      }
      return $store;
    }

	// public static function edit($id){
	//     return $row = \DB::table('tab_mantenimiento_camion')
	// 	->join ('tab_camion','tab_mantenimiento_camion.id_camion', '=', 'tab_camion.id_camion')
	// 	->join ('tab_mantenimiento','tab_mantenimiento_camion.id_mantenimiento', '=', 'tab_mantenimiento.id_mantenimiento')
	//     ->where('estado_man', 'A')
	//     ->where('tab_mantenimiento_camion.id_camion', $id)
	//     ->select('*')
	//     ->get();
 //    }



	public static function edit($id){
		$resultado = DB::select("SELECT tab_camion.matricula, tab_camion.modelo, tab_camion.marca, tab_camion.tipo_vehiculo, tab_mantenimiento.mantenimiento, tab_mantenimiento.descripcion_man, T1.id_mantenimiento_camion,T1.id_mantenimiento,T1.id_camion, T1.observacion, T1.fecha_man, T1.fecha_prox_revision
                                 FROM tab_mantenimiento_camion T1 
                                 INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
                                 INNER JOIN tab_mantenimiento ON(T1.id_mantenimiento=tab_mantenimiento.id_mantenimiento)
							     INNER JOIN ( SELECT tab_mantenimiento_camion.id_mantenimiento_camion, MAX(tab_mantenimiento_camion.id_mantenimiento_camion) AS max_id , tab_mantenimiento_camion.id_camion
									          FROM tab_mantenimiento_camion 
											  GROUP BY tab_mantenimiento_camion.id_camion, tab_mantenimiento_camion.id_mantenimiento ) T2 ON T1.id_camion = T2.id_camion 
								 AND T1.id_mantenimiento_camion = T2.max_id
								 WHERE T1.id_camion=$id");
        return $resultado; 
	}

    public static function updat($request, $id){   
      $store = false;
      $post=$request->all();
      $lista = $post['dato'];
      for ($x = 0; $x < count($lista);$x++){
        $index = $lista[$x];
        $row = array(  
         'observacion' => mb_strtoupper($post['observacion_'.$index]),
         'fecha_man' => $post['fecha_man_'.$index],
         'fecha_prox_revision' => $post['fecha_prox_'.$index]
         );
        $item= \DB::table('tab_mantenimiento_camion')
				    ->where ('id_mantenimiento_camion', $post['id_mantenimiento_camion_'.$index])
				    ->update($row);
        $store = $item > 0?true:$store;
      }
      return $store; 
    }


	public static function editModal($id){
	    return $row = \DB::table('tab_mantenimiento_camion')
		->join ('tab_camion','tab_mantenimiento_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_mantenimiento','tab_mantenimiento_camion.id_mantenimiento', '=', 'tab_mantenimiento.id_mantenimiento')
	    ->where('estado_man', 'A')
	    ->where('tab_mantenimiento_camion.id_mantenimiento_camion', $id)
	    ->select('*')
	    ->first();
    }
    public static function add($data){
	    return DB::table('tab_mantenimiento_camion')->insert($data);
	} 

    public static function delet($id){
	    return $i= \DB::table('tab_mantenimiento_camion')
	    ->where ('id_camion',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado_man' => 'I');
	    return $i= \DB::table('tab_mantenimiento_camion')
	    ->where ('id_mantenimiento_camion',$id)
	    ->update($row);
    }

	public static function repHisManjq($val){
	    return $row = \DB::table('tab_mantenimiento_camion')
		->join ('tab_camion','tab_mantenimiento_camion.id_camion', '=', 'tab_camion.id_camion')
		->join ('tab_mantenimiento','tab_mantenimiento_camion.id_mantenimiento', '=', 'tab_mantenimiento.id_mantenimiento')
	    ->where('estado_man', 'A')
	    ->where('tab_mantenimiento_camion.id_camion', $val)
	    ->select('*')
	    ->orderBy('tab_mantenimiento_camion.id_camion','ASC')
	    ->orderBy('tab_mantenimiento_camion.fecha_man','DESC')
	    ->get();
    }

	public static function repManjq(){
		$resultado = DB::select("SELECT tab_camion.matricula, tab_camion.modelo, tab_camion.marca, tab_camion.tipo_vehiculo, tab_mantenimiento.mantenimiento, tab_mantenimiento.descripcion_man, T1.id_mantenimiento_camion,T1.id_mantenimiento,T1.id_camion, T1.observacion, T1.fecha_man, T1.fecha_prox_revision
                                 FROM tab_mantenimiento_camion T1 
                                 INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
                                 INNER JOIN tab_mantenimiento ON(T1.id_mantenimiento=tab_mantenimiento.id_mantenimiento)
							     INNER JOIN ( SELECT tab_mantenimiento_camion.id_mantenimiento_camion, MAX(tab_mantenimiento_camion.id_mantenimiento_camion) AS max_id , tab_mantenimiento_camion.id_camion
									          FROM tab_mantenimiento_camion 
											  GROUP BY tab_mantenimiento_camion.id_camion, tab_mantenimiento_camion.id_mantenimiento ) T2 ON T1.id_camion = T2.id_camion 
								 AND T1.id_mantenimiento_camion = T2.max_id");
        return $resultado; 
	}

	public static function repManjq1($val2){
		$resultado = DB::select("SELECT tab_camion.matricula, tab_camion.modelo, tab_camion.marca, tab_camion.tipo_vehiculo, tab_mantenimiento.mantenimiento, tab_mantenimiento.descripcion_man, T1.id_mantenimiento_camion,T1.id_mantenimiento,T1.id_camion, T1.observacion, T1.fecha_man, T1.fecha_prox_revision
                                 FROM tab_mantenimiento_camion T1 
                                 INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
                                 INNER JOIN tab_mantenimiento ON(T1.id_mantenimiento=tab_mantenimiento.id_mantenimiento)
							     INNER JOIN ( SELECT tab_mantenimiento_camion.id_mantenimiento_camion, MAX(tab_mantenimiento_camion.id_mantenimiento_camion) AS max_id , tab_mantenimiento_camion.id_camion
									          FROM tab_mantenimiento_camion 
											  GROUP BY tab_mantenimiento_camion.id_camion, tab_mantenimiento_camion.id_mantenimiento ) T2 ON T1.id_camion = T2.id_camion 
								 AND T1.id_mantenimiento_camion = T2.max_id
								 WHERE T1.id_camion='$val2'");
        return $resultado; 
	}

	public static function repManjq2($val,$val1){
		$resultado = DB::select("SELECT tab_camion.matricula, tab_camion.modelo, tab_camion.marca, tab_camion.tipo_vehiculo, tab_mantenimiento.mantenimiento, tab_mantenimiento.descripcion_man, T1.id_mantenimiento_camion,T1.id_mantenimiento,T1.id_camion, T1.observacion, T1.fecha_man, T1.fecha_prox_revision
                                 FROM tab_mantenimiento_camion T1 
                                 INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
                                 INNER JOIN tab_mantenimiento ON(T1.id_mantenimiento=tab_mantenimiento.id_mantenimiento)
							     INNER JOIN ( SELECT tab_mantenimiento_camion.id_mantenimiento_camion, MAX(tab_mantenimiento_camion.id_mantenimiento_camion) AS max_id , tab_mantenimiento_camion.id_camion
									          FROM tab_mantenimiento_camion 
											  GROUP BY tab_mantenimiento_camion.id_camion, tab_mantenimiento_camion.id_mantenimiento ) T2 ON T1.id_camion = T2.id_camion 
								 AND T1.id_mantenimiento_camion = T2.max_id								 
		                         WHERE T1.fecha_man>='$val'
		                         AND T1.fecha_man<='$val1'");
        return $resultado; 
	}

	public static function repManjq3($val,$val1,$val2){
		$resultado = DB::select("SELECT tab_camion.matricula, tab_camion.modelo, tab_camion.marca, tab_camion.tipo_vehiculo, tab_mantenimiento.mantenimiento, tab_mantenimiento.descripcion_man, T1.id_mantenimiento_camion,T1.id_mantenimiento,T1.id_camion, T1.observacion, T1.fecha_man, T1.fecha_prox_revision
                                 FROM tab_mantenimiento_camion T1 
                                 INNER JOIN tab_camion ON(T1.id_camion=tab_camion.id_camion)
                                 INNER JOIN tab_mantenimiento ON(T1.id_mantenimiento=tab_mantenimiento.id_mantenimiento)
							     INNER JOIN ( SELECT tab_mantenimiento_camion.id_mantenimiento_camion, MAX(tab_mantenimiento_camion.id_mantenimiento_camion) AS max_id , tab_mantenimiento_camion.id_camion
									          FROM tab_mantenimiento_camion 
											  GROUP BY tab_mantenimiento_camion.id_camion, tab_mantenimiento_camion.id_mantenimiento ) T2 ON T1.id_camion = T2.id_camion 
								 AND T1.id_mantenimiento_camion = T2.max_id
								 WHERE T1.id_camion=$val2								 
		                         AND T1.fecha_man>='$val'
		                         AND T1.fecha_man<='$val1'");
        return $resultado; 
	}
} 
