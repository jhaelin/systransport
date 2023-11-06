@if($errors->any())
  <div class="col-md-8 alert" style="background:#f7d651;" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <p>Debe corregir los Errores que se muestran :</p>
	  <ul>
	     @foreach($errors->all() as $error)
	        <li>{{$error}}</li>
	     @endforeach
	  </ul>
  </div>
@endif