<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
 
class ModelCliente extends Model
{
	protected $table = 'tab_cliente';
    protected $fillable = ['title','post'];

    public static function cliente(){ 
	    return DB::table('tab_cliente')
	    ->select('*')
	    ->where('estado_cli','A')
	    ->orderBy('nombre_representante','DESC') 
	    ->get();
	}  
 
	public static function vcliente(){ 
		return DB::table('tab_cliente')
		->join ('tab_admin_flete_camion','tab_cliente.id_cliente', '=', 'tab_admin_flete_camion.id_cliente')
	    ->select('tab_cliente.id_cliente')
	    ->get();
	}

    public static function store($data){
	    return DB::table('tab_cliente')->insert($data);
	}  

	public static function edit($id){
	    return $row = \DB::table('tab_cliente')
	    ->where('estado_cli', 'A')
	    ->where('id_cliente', $id)
	    ->select('*')
	    ->first();
    }

    public static function updat($row, $id){
	    return $i= \DB::table('tab_cliente')
	    ->where ('id_cliente', $id)
	    ->update($row); 
    }

    public static function delet($id){
	    return $i= \DB::table('tab_cliente')
	    ->where ('id_cliente',$id)
	    ->delete();
    }

    public static function delet_($id){
	    $row = array('estado_cli' => 'I');
	    return $i= \DB::table('tab_cliente')
	    ->where ('id_cliente',$id)
	    ->update($row);
    } 

	public static function reporteCliente($val){ 
	    return DB::table('tab_cliente')
	    ->select('*')
	    ->where('tab_cliente.id_cliente',$val)
	    ->get();
	}
}