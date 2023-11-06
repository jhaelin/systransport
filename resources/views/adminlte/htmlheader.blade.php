<head> 
    <meta charset="UTF-8">
    <title>  </title>  
    <style> textarea{ text-align : justify;}</style> 
    <html lang="{{ config('app.locale') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/img/logo_.png') }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('adminlte/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">
    <!-- Date Select -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/color_tables.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/css/tablas.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/css/mensaje.css')}}">


 
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/red.css')}}" >

    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">

    <!-- Toggle -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/toggle/css/bootstrap-toggle.min.css')}}" >

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('adminlte/plugins/tooltipster/css/tooltipster.bundle.min.css')}}" />


<!--     <link rel="stylesheet" href="{{asset('adminlte/plugins/multi_filter_select/jquery.dataTables.css')}}">
 -->    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="{{'adminlte/plugins/_all.css'}}"> -->
    <script type="text/javascript">
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
    </head> 


