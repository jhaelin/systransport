<!-- Copyright © 2022 mcall -->   
<!-- REQUIRED JS SCRIPTS -->      

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js  precio_unitario--> 
<!-- Laravel App  enviar_techo   accion_cp_ajax-->  
<script src="{{asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script> 

<script type="text/javascript">  
  window.Laravel = {!! json_encode([    
    'csrfToken' => csrf_token(),   
    ]) !!};
</script>

<script type="text/javascript">  
  $(".chosen-select").chosen();   
</script>


<script type="text/javascript">   
  $(document).ready(function()
  {
    $('#datatables').DataTable({ 
      "pagingType":"full_numbers", 
      "lengthMenu":[
      [10,25,50,-1], 
      [10,25,50,"Todo"]
      ],
      responsive:true,
      language: {
        serarch: "_INPUT_",
        serarchPlaceholder:
        "Buscar","lengthMenu":"Mostrar _MENU_ Registro por página",
        "zeroRecords": "No se encontro ni un registro","info":"Mostrando pagina_PAGE_de_PAGES_",
        "infoEmpty": "No hay registros","infoFiltered":"(Filtro de_MAX_registros)",
        "paginate":{
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        },
        "sSearch":"Buscar",
        "decimal": "",
        "emptyTable": "No existe ningun registro...",
        "infoPostFix": "",
        "thousands": ",",
        "loadingRecords":
        "Cargando registros...",
        "processing":
        "Procesando registro...", 
      }
    });
  });
</script>
<script src="{{asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

      <!-- jQuery UI 1.11.4 -->
      <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

      <!-- Sparkline -->
      <script src="{{asset('/adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
      <!-- jvectormap -->
      <script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
      <script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
      <!-- datepicker -->
      <script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

      <!-- Bootstrap WYSIHTML5 -->
      <script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
      <!-- Slimscroll -->
      <script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
      <!-- FastClick -->
      <script src="{{asset('adminlte/plugins/fastclick/fastclick.min.js')}}"></script>
      <!-- Toggle  -->
      <script src="{{asset('adminlte/plugins/toggle/js/bootstrap-toggle.min.js')}}"></script>
      <script src="{{asset('adminlte/plugins/datepicker/locales/bootstrap-datepicker.es.js')}}"></script>
      <script type="text/javascript" src="{{asset('adminlte/plugins/tooltipster/js/tooltipster.bundle.min.js')}}"></script>
      <!-- General-->
      <script type="text/javascript" src="{{asset('adminlte/plugins/blockui/jquery.blockUI.js')}}"></script>
      <!-- AdminLTE App -->
      <script src="{{asset('adminlte/js/app.min.js')}}"></script>

      <script type="text/javascript">
        $(document).ready(function(){
          $(".select2").select2();
          $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true
          });
          $('#date').click(function(){
            var id = $(this).val();
          });
          $('#fecha1').click(function(){
            var id = $(this).val();
          });
          $('.tooltip').tooltipster();
        });
      </script>

      <script type="text/javascript">

        function informacion(){
           document.getElementById('informacion').style.display = 'block';
           document.getElementById('configuracion').style.display = 'none';
           document.getElementById('actualizacion').style.display = 'none';
        }

        function configuracion(){
           document.getElementById('informacion').style.display = 'none';
           document.getElementById('configuracion').style.display = 'block';
           document.getElementById('actualizacion').style.display = 'none';
        }

        function actualizacion(){
           document.getElementById('informacion').style.display = 'none';
           document.getElementById('configuracion').style.display = 'none';
           document.getElementById('actualizacion').style.display = 'block';
        }
        
      	function sector(i) {
      		var d = i;
      		var id = document.getElementById("id_sector_economico_"+d).value;
      		var url="{{asset('/sectorAjax')}}"; 
      		$.post(url,{id:id},
      			function(respuesta){
      				$("#denominacion_sector_"+i).html(respuesta);
      			}); 
      	}

        function sum() {
          var valor1 = document.getElementById("cantidad").value; 
          var valor2 = document.getElementById("unidad").value;
          var Total= parseFloat(valor1)+parseFloat(valor2);
            document.getElementById("total").value = (parseFloat(valor1)*parseFloat(valor2));
        }
         //PERFIL
        $('.foto').change(function(){
           $('.actualizarbtn').show();
        }); 
     //PERFIL
        $('#p_actual').change(function(){ 
          var val = $(this).val();
          //alert(val);
          var url = "{{asset('actpassw')}}";
          var mensaje='cargando...';
           $('#un').html(mensaje);
           $.post(url,{val:val}, function(result){
             if(result=='1'){
                  $('.si').show();
                  $('#un').hide();
             }else{
                  $('#un').html(result);
                  $('.si').hide();
             }
            });
        });

        $('#confpassword').keyup(function(){
          var pass_1 = $('#p_nuevo').val();
          var pass_2 = $('#confpassword').val();
          var _this = $('#confpassword');
                      _this.attr('style', 'background:white');
          if(pass_1 != pass_2 || pass_2 == ''){
            _this.attr('style', 'background:#f5f58b');
            $("#incorrecto").show();
                  $("#correcto").hide();
                  $('.sibtn').hide();
                  return false;
          }else{
            _this.attr('style', 'background:#ffffff');
            $("#correcto").show();
            $('.sibtn').show();
                  $("#incorrecto").hide();
                  return true;
          }
        });
        // FOTO 
        $('.archivo').click(function(){ 
           //$('.archivo3').hide();
           //$('.archivo2').hide();
           $(".archivo2").attr('disabled','disabled');
        });

        $('.monto_p').blur(function(){
          //alert('hj');
          var monto = $('#monto_partida').val();
          if(monto==''){ $('#monto').val('0');}
          else{$('#monto').val(monto);}
        });



        $('#archivo').click(function(){ 
           //$('.archivo3').hide();
           //$('.archivo2').hide();
           $(".archivo2").attr('disabled','disabled');
        });

        // $('.sum').blur(function(){ 
        //   var val1 = $('#cantidad').val();
        //   var val2 = $('#unidad').val();
        //   alert(val1+val2);
        //   var suma=(val1+val2);

        //   $('#total').val(suma);
        // });  
        // INGRESO --> PLACA -- ID_FLETE
        $('.placa').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('ingresoFlete3js')}}";
          var mensaje='cargando...';
           $('.cam').html(mensaje);
          $.post(url,{val:val}, function(result){$('.cam').html(result);});
        });

        // INGRESO --> PLACA -- CLIENTE
        $('.placa').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('ingresoFletejs')}}";
          var mensaje='cargando...';
           $('.cliente').html(mensaje);
          $.post(url,{val:val}, function(result){ $('.cliente').html(result);});
        });


        // INGRESO --> CLIENTE -- RUTA
        $('.placa').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('ingresoFlete2js')}}";
          var mensaje='cargando...';
           $('.ruta').html(mensaje);
          $.post(url,{val:val}, function(result){ $('.ruta').html(result);});
        });


        // REPORTE 1
        $('#tipo').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('repUsjq')}}";
          var mensaje='cargando...';
           $('.tbody').html(mensaje);
          $.post(url,{val:val}, function(result){ $('.tbody').html(result);});
        });

        // REPORTE 2
        $('#camion').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('repCamjq')}}";
          var mensaje='cargando...';
           $('.tbody').html(mensaje);
          $.post(url,{val:val}, function(result){ $('.tbody').html(result);});
        });  

        // REPORTE 3
        $('#cliente').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('repClijq')}}";
          var mensaje='cargando...';
           $('.tbody').html(mensaje);
          $.post(url,{val:val}, function(result){ $('.tbody').html(result);});
        });   

        // REPORTE 4
        $('#conductor').change(function(){ 
          var val = $(this).val();
          var url = "{{asset('repConjq')}}";
          var mensaje='cargando...';
           $('.tbody').html(mensaje);
          $.post(url,{val:val}, function(result){ $('.tbody').html(result);});
        });        

        // REPORTE 5
        $('.fech').change(function(){ 
          $('input[type=checkbox]').prop("checked", false);
          $(".fech").prop('disabled', false);
        });

        $('.busc').change(function(){ 
            if( $('#md_checkbox_35').prop('checked') ) {
                $(".fech").prop('disabled', true);
                $(".fech").val('');
                var val = $('input[type=checkbox]').val();
                var val1 = '';
                var val2 = $('#estado').val();
                var url = "{{asset('repFlejq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{val:val, val1:val1, val2:val2}, function(result){ $('.tbody').html(result);});
            } else {
                $(".fech").prop('disabled', false);
                var val = $('#f1').val();
                var val1 = $('#f2').val();
                var val2 = $('#estado').val();
                var url = "{{asset('repFlejq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{ val:val, val1:val1, val2:val2}, function(result){ $('.tbody').html(result);});
            }
        }); 

        // REPORTE 6
        $('#idcamion').change(function(){ 
          var val = $(this).val();
          $('#btnhist').hide();
          //alert('hsdhgsf');
          var url = "{{asset('repHisManjq')}}";
          var mensaje='cargando...';
           $('#datos').html(mensaje);
          $.post(url,{val:val}, function(result){ $('#datos').html(result); $('#btnhist').show();});
        });  

        // REPORTE 7
        $('.buscarmant').change(function(){ 
            if( $('#md_checkbox_35').prop('checked') ) {
                //alert('Seleccionado');
                $(".fech").prop('disabled', true);
                $(".fech").val('');
                var val = $('input[type=checkbox]').val();
                var val1 = '';
                var val2= $('#idcamion').val();
                var url = "{{asset('repManjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{val:val, val1:val1, val2:val2}, function(result){ $('.tbody').html(result);});
            } else{
                $(".fech").prop('disabled', false);
                var val = $('#f1').val();
                var val1 = $('#f2').val();
                var val2= $('#idcamion').val();
                var url = "{{asset('repManjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{ val:val, val1:val1, val2:val2}, function(result){ $('.tbody').html(result);});
            }
        });  

        // REPORTE 8

        $('.buscaringreso').change(function(){ 
            if( $('#md_checkbox_35').prop('checked') ) {
                //alert('Seleccionado');
                $(".fech").prop('disabled', true);
                $(".fech").val('');
                var val = $('input[type=checkbox]').val();
                var val1 = '';
                var val2= $('#id_cliente').val();
                var url = "{{asset('repIngjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                //alert('hjf');
                $.post(url,{val:val, val1:val1, val2:val2}, function(result){ $('.tbody').html(result);});
            } else{
                //alert('no checked');
                $(".fech").prop('disabled', false);
                var val = $('#f1').val();
                var val1 = $('#f2').val();
                var val2= $('#id_cliente').val();
                var url = "{{asset('repIngjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{ val:val, val1:val1, val2:val2}, function(result){ $('.tbody').html(result);});
            }
        }); 

        // REPORTE 9

        $('.buscar').change(function(){ 
            if( $('#md_checkbox_35').prop('checked') ) {
                $(".fech").prop('disabled', true);
                $(".fech").val('');
                var val = $('input[type=checkbox]').val();
                var val1 = '';
                var url = "{{asset('repEgjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                //alert('hjf');
                $.post(url,{val:val, val1:val1}, function(result){ $('.tbody').html(result);});
            } else {
                $(".fech").prop('disabled', false);
                var val = $('#f1').val();
                var val1 = $('#f2').val();
                var url = "{{asset('repEgjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{ val:val, val1:val1}, function(result){ $('.tbody').html(result);});
            }
        });  

        // REPORTE 10

        $('.buscarimp').change(function(){ 
            if( $('#md_checkbox_35').prop('checked') ) {
                $(".fech").prop('disabled', true);
                $(".fech").val('');
                var val = $('input[type=checkbox]').val();
                var val1 = '';
                var url = "{{asset('repImpjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                //alert('hjf');
                $.post(url,{val:val, val1:val1}, function(result){ $('.tbody').html(result);});
            } else {
                $(".fech").prop('disabled', false);
                var val = $('#f1').val();
                var val1 = $('#f2').val();
                var url = "{{asset('repImpjq')}}";
                var mensaje='cargando...';
                $('.tbody').html(mensaje);
                $.post(url,{ val:val, val1:val1}, function(result){ $('.tbody').html(result);});
            }
        });   
      </script>

      <script type="text/javascript">
        function permite(elEvento, permitidos) { 
          var numeros = "0123456789";
          var caracteres = " aábcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZéíóúñü";
          var numeros_caracteres = numeros + caracteres;
          var ctrl=window.event.ctrlKey;
          var teclas_especiales = [8, 37, 39, 46];
          var tecla=window.event.keyCode;
          var alt=window.event.altKey;
          var t_esp = [45, 95,17];
          var esp = numeros + caracteres + t_esp;

          switch(permitidos) {
            case 'num':
            permitidos = numeros;
            break;
            case 'car':
            permitidos = caracteres;
            break;
            case 'num_car':
            permitidos = numeros_caracteres;
            break;
            case 't_esp':
            permitidos = t_esp;
            break;
            case 'num_car_esp':
            permitidos = esp;
            break;

          }
          var evento = elEvento || window.event;
          var codigoCaracter = evento.charCode || evento.keyCode; 
          var caracter = String.fromCharCode(codigoCaracter);
          var tecla_especial = false;
          for(var i in teclas_especiales) {
            if(codigoCaracter == teclas_especiales[i]) {
              tecla_especial = true;
              break;
            }
          }
          return permitidos.indexOf(caracter) != -1 || tecla_especial;
        }
      </script>

      <!-- Persona  Nuevo y Editar-->
<script type="text/javascript">
  $(document).ready(function(){   
    $("#formPerson").submit(function() {
      nombre();materno();ci();expedido();archivo();zona();calle();numero();cel();
      if(nombre()&&materno()&&ci()&&expedido()&&zona()&&calle()&&numero()&&archivo()&&cel()){     
        $("#exito").show();
        $("#error").hide();
        return true;
      }else 
      $("#error").show();
      $("#exito").hide();
      return false;     
    });
  });
</script>

<script type="text/javascript">
  function validarp(){  nombre();materno();ci();expedido();archivo();zona();calle();numero();cel();}
  function validarc(){  nombre();materno();ci();expedido();archivo();zona();calle();numero();cel();}

  function validar(){  nombre();materno();ci();expedido();archivo();zona();calle();numero();cel();email(); 
    id_pilar();id_meta();id_resultado();id_accion();id_gestion();id_pei();fecha_envio();mae();responsable_planificacion();responsable_presupuesto();responsable_elabora();
    cod_poa();ccod_poa();denominacion_poa();bien_norma_servicio();rows();
  }
  function nombre(){ var input=$('input#nombre').val(); if(input!=''){$('input#nombre').css({"border-color":"#008749"}); return true;}else{ $('input#nombre').css({"border-color":"#d33724"}); return false;} }
  function materno(){ var input=$('input#materno').val(); if(input!=''){$('input#materno').css({"border-color":"#008749"}); return true;}else{ $('input#materno').css({"border-color":"#d33724"}); return false;}}
  function ci(){ var input=$('input#ci').val(); if(input!=''){$('input#ci').css({"border-color":"#008749"}); return true;}else{ $('input#ci').css({"border-color":"#d33724"}); return false;}}
  function expedido(){ var select=$('select#expedido').val(); if(select!=''){$('select#expedido').css({"border-color":"#008749"}); return true;}else{ $('select#expedido').css({"border-color":"#d33724"}); return false;}}
  function archivo(){ var input=$('input#archivo').val();if(input!=''){$('input#archivo').css({"border-color":"#008749"}); return true;}else{ $('input#archivo').css({"border-color":"#d33724"}); return false;}}
  function zona(){ var input=$('input#zona').val();if(input!=''){$('input#zona').css({"border-color":"#008749"}); return true;}else{ $('input#zona').css({"border-color":"#d33724"}); return false;}}
  function calle(){var input=$('input#calle').val(); if(input!=''){$('input#calle').css({"border-color":"#008749"}); return true;}else{ $('input#calle').css({"border-color":"#d33724"}); return false;}}
  function numero(){ var input=$('input#num').val();if(input!=''){$('input#num').css({"border-color":"#008749"}); return true;}else{ $('input#num').css({"border-color":"#d33724"}); return false;}}
  function cel(){ var input=$('input#cel').val();if(input!=''){$('input#cel').css({"border-color":"#008749"}); return true;}else{ $('input#cel').css({"border-color":"#d33724"}); return false;}}
  function tel(){ var input=$('input#tel').val();if(input!=''){$('input#tel').css({"border-color":"#008749"}); return true;}else{ $('input#tel').css({"border-color":"#d33724"}); return false;}}

  function email(){ var input=$('input#email').val(); 
  if(input!=''){$('input#email').css({"border-color":"#008749"}); return true;}
  else{ $('input#email').css({"border-color":"#d33724"}); return false;}}
  
  function fecha_ingreso(){ var input=$('input#fecha_ingreso').val(); if(input!=''){$('input#fecha_ingreso').css({"border-color":"#008749"}); return true;}else{ $('input#fecha_ingreso').css({"border-color":"#d33724"}); return false;}}

  function id_organigrama(){var select=$('select#id_organigrama').val(); if(select!=''){$('select#id_organigrama').css({"border-color":"#008749"}); return true;}else{ $('select#id_organigrama').css({"border-color":"#d33724"}); return false;}}
  function id_cargo(){var select=$('select#id_cargo').val(); if(select!=''){$('select#id_cargo').css({"border-color":"#008749"}); return true;}else{ $('select#id_cargo').css({"border-color":"#d33724"}); return false;}}
  function id_rol(){var select=$('select#id_rol').val(); if(select!=''){$('select#id_rol').css({"border-color":"#008749"}); return true;}else{ $('select#id_rol').css({"border-color":"#d33724"}); return false;}}
  function password(){ var input=$('input#password').val(); if(input!=''){$('input#password').css({"border-color":"#008749"}); return true;}else{ $('input#password').css({"border-color":"#d33724"}); return false;} }
  function confirmar_password(){ var input=$('input#confirmar_password').val(); if(input!=''){$('input#confirmar_password').css({"border-color":"#008749"}); return true;}else{ $('input#confirmar_password').css({"border-color":"#d33724"}); return false;} }
  function name(){ var input=$('input#name').val(); if(input!=''){$('input#name').css({"border-color":"#008749"}); return true;}else{ $('input#name').css({"border-color":"#d33724"}); return false;} }

  //PEI
  function cod_pei(){ var input=$('input#cod_pei').val(); if(input!=''){$('input#cod_pei').css({"border-color":"#008749"}); return true;}else{ $('input#cod_pei').css({"border-color":"#d33724"}); return false;}}
  function objetivo_estrategico_pei(){ var textarea=$('textarea#objetivo_estrategico_pei').val(); if(textarea!=''){$('textarea#objetivo_estrategico_pei').css({"border-color":"#008749"}); return true;}else{ $('textarea#objetivo_estrategico_pei').css({"border-color":"#d33724"}); return false;}}
  function responsable_directo_pei(){ var select=$('select#responsable_directo_pei').val(); if(select!=''){$('select#responsable_directo_pei').css({"border-color":"#008749"}); return true;}else{ $('select#responsable_directo_pei').css({"border-color":"#d33724"}); return false;}}
  
  //FORM1
  function id_pilar(){ var select=$('select#id_pilar').val(); if(select!=''){$('select#id_pilar').css({"border-color":"#008749"}); return true;}else{ $('select#id_pilar').css({"border-color":"#d33724"}); return false;}}
  function id_meta(){ var select=$('select#id_meta').val(); if(select!=''){$('select#id_meta').css({"border-color":"#008749"}); return true;}else{ $('select#id_meta').css({"border-color":"#d33724"}); return false;}}
  function id_resultado(){ var select=$('select#id_resultado').val(); if(select!=''){$('select#id_resultado').css({"border-color":"#008749"}); return true;}else{ $('select#id_resultado').css({"border-color":"#d33724"}); return false;}}
  function id_accion(){ var select=$('select#id_accion').val(); if(select!=''){$('select#id_accion').css({"border-color":"#008749"}); return true;}else{ $('select#id_accion').css({"border-color":"#d33724"}); return false;}}
  function id_gestion(){ var select=$('select#id_gestion').val(); if(select!=''){$('select#id_gestion').css({"border-color":"#008749"}); return true;}else{ $('select#id_gestion').css({"border-color":"#d33724"}); return false;}}
  function id_pei(){ var select=$('select#id_pei').val(); if(select!=''){$('select#id_pei').css({"border-color":"#008749"}); return true;}else{ $('select#id_pei').css({"border-color":"#d33724"}); return false;}}
  function fecha_envio(){ var input=$('input#fecha_envio').val(); if(input!=''){$('input#fecha_envio').css({"border-color":"#008749"}); return true;}else{ $('input#fecha_envio').css({"border-color":"#d33724"}); return false;}}
  function mae(){ var select=$('select#mae').val(); if(select!=''){$('select#mae').css({"border-color":"#008749"}); return true;}else{ $('select#mae').css({"border-color":"#d33724"}); return false;}}
  function responsable_planificacion(){ var select=$('select#responsable_planificacion').val(); if(select!=''){$('select#responsable_planificacion').css({"border-color":"#008749"}); return true;}else{ $('select#responsable_planificacion').css({"border-color":"#d33724"}); return false;}}
  function responsable_presupuesto(){ var select=$('select#responsable_presupuesto').val(); if(select!=''){$('select#responsable_presupuesto').css({"border-color":"#008749"}); return true;}else{ $('select#responsable_presupuesto').css({"border-color":"#d33724"}); return false;}}
  function responsable_elabora(){ var select=$('select#responsable_elabora').val(); if(select!=''){$('select#responsable_elabora').css({"border-color":"#008749"}); return true;}else{ $('select#responsable_elabora').css({"border-color":"#d33724"}); return false;}}
  //FORM1 ITEM
  function cod_poa(){ var input=$('input#cod_poa').val(); if(input!=''){$('input#cod_poa').css({"border-color":"#008749"}); return true;}else{ $('input#cod_poa').css({"border-color":"#d33724"}); return false;}}
  function ccod_poa(){ var input=$('input#ccod_poa').val(); if(input!=''){$('input#ccod_poa').css({"border-color":"#008749"}); return true;}else{ $('input#ccod_poa').css({"border-color":"#d33724"}); return false;}}
  function denominacion_poa(){ var input=$('input#denominacion_poa').val(); if(input!=''){$('input#denominacion_poa').css({"border-color":"#008749"}); return true;}else{ $('input#denominacion_poa').css({"border-color":"#d33724"}); return false;}}
  function bien_norma_servicio(){ var input=$('input#bien_norma_servicio').val(); if(input!=''){$('input#bien_norma_servicio').css({"border-color":"#008749"}); return true;}else{ $('input#bien_norma_servicio').css({"border-color":"#d33724"}); return false;}}
  function rows(){ var input=$('input#rows').val(); if(input!=''){$('input#rows').css({"border-color":"#008749"}); return true;}else{ $('input#rows').css({"border-color":"#d33724"}); return false;}}

</script>