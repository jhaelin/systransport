<?php namespace App\Http\Controllers;                         
use DB;use Session;use Redirect;use Carbon\Carbon;use Illuminate\Http\Request;use Illuminate\Routing\Route;use Illuminate\Http\RedirectRequest;use App\Http\Controllers\Controller;use Illuminate\Database\Eloquent\Model;use Illuminate\Support\Facades\Validator; use Crypt;use FPDF;use Auth;

class FpdfReporteController extends Controller {

	public function __construct(){ 
		$this->middleware('auth');
	} 
    
    public function usuarioPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfUsuario.php');
        $rep = New FpdfUsuario();
        $rep->usuarioPdf($request);
    }
    
    public function camionPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfCamion.php');
        $rep = New FpdfCamion();
        $rep->camionPdf($request);
    }
    
    public function clientePdf(request $request){
        include(app_path().'/Http/Controllers/FpdfCliente.php');
        $rep = New FpdfCliente();
        $rep->clientePdf($request);
    }
    
    public function conductorPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfConductor.php');
        $rep = New FpdfConductor();
        $rep->conductorPdf($request);
    }
    
    public function fletePdf(request $request){
        include(app_path().'/Http/Controllers/FpdfFlete.php');
        $rep = New FpdfFlete();
        $rep->fletePdf($request);
    }
    
    public function egresoPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfEgreso.php');
        $rep = New FpdfEgreso();
        $rep->egresoPdf($request);
    }
    
    public function ingresoPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfIngreso.php');
        $rep = New FpdfIngreso();
        $rep->ingresoPdf($request);
    }
    
    public function impuestoPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfImpuesto.php');
        $rep = New FpdfImpuesto();
        $rep->impuestoPdf($request);
    }
    
    public function histmantenimientoPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfHistMantenimiento.php');
        $rep = New FpdfHistMantenimiento();
        $rep->histmantenimientoPdf($request);
    }
    
    public function mantenimientoPdf(request $request){
        include(app_path().'/Http/Controllers/FpdfMantenimiento.php');
        $rep = New FpdfMantenimiento();
        $rep->mantenimientoPdf($request);
    }
}