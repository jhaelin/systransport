<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ModelEmpresa extends Model
{
    public static function emp(){ 
	    return DB::table('tab_empresa')
	    ->first();
	}
   
    public static function gestion(){ 
	    return DB::table('tab_gestion')
	    ->orderBy('gestion','asc')
	    ->get();
	} 
}
