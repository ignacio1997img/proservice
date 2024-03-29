<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <title>@yield('page_title', setting('admin.title') . " - " . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="assets-path" content="{{ route('voyager.voyager_assets') }}"/>

    @yield('meta')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">


    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif
    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}">


    



    <!-- App CSS -->
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

    @yield('css')
    @if(__('voyager::generic.is_rtl') == 'true')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
    @endif

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:{{ config('voyager.primary_color','#22A7F0') }};
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .voyager .breadcrumb a{
            color:{{ config('voyager.primary_color','#22A7F0') }};
        }



        #subtitle{
            font-size: 18px;
            color: rgb(12, 12, 12);
            font-weight: bold;
        }
        small{font-size: 12px;
            color: rgb(12, 12, 12);
            font-weight: bold;
        }
        
    </style>

    @if(!empty(config('voyager.additional_css')))<!-- Additional CSS -->
        @foreach(config('voyager.additional_css') as $css)<link rel="stylesheet" type="text/css" href="{{ asset($css) }}">@endforeach
    @endif

    @yield('head')
</head>

<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif">

<div id="voyager-loader">
    <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
    @if($admin_loader_img == '')
        <img src="{{ asset('images/loading.png') }}" alt="Voyager Loader">
    @else
        <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
    @endif
</div>

<?php
if (\Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'http://') || \Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'https://')) {
    $user_avatar = Auth::user()->avatar;
} else {
    $user_avatar = Voyager::image(Auth::user()->avatar);
}
?>

<div class="app-container">
    <div class="fadetoblack visible-xs"></div>
    <div class="row content-container">
        @include('voyager::dashboard.navbar')
        @include('voyager::dashboard.sidebar')
        <script>
            (function(){
                    var appContainer = document.querySelector('.app-container'),
                        sidebar = appContainer.querySelector('.side-menu'),
                        navbar = appContainer.querySelector('nav.navbar.navbar-top'),
                        loader = document.getElementById('voyager-loader'),
                        hamburgerMenu = document.querySelector('.hamburger'),
                        sidebarTransition = sidebar.style.transition,
                        navbarTransition = navbar.style.transition,
                        containerTransition = appContainer.style.transition;

                    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition =
                    appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition =
                    navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = 'none';

                    if (window.innerWidth > 768 && window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
                        appContainer.className += ' expanded no-animation';
                        loader.style.left = (sidebar.clientWidth/2)+'px';
                        hamburgerMenu.className += ' is-active no-animation';
                    }

                   navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = navbarTransition;
                   sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition = sidebarTransition;
                   appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition = containerTransition;
            })();
        </script>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('page_header')
                <div id="voyager-notifications"></div>
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('voyager::partials.app-footer')

<!-- Javascript Libs -->


<script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>

<script>
    @if(Session::has('alerts'))
        let alerts = {!! json_encode(Session::get('alerts')) !!};
        helpers.displayAlerts(alerts, toastr);
    @endif

    @if(Session::has('message'))

    // TODO: change Controllers to use AlertsMessages trait... then remove this
    var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
    var alertMessage = {!! json_encode(Session::get('message')) !!};
    var alerter = toastr[alertType];

    if (alerter) {
        alerter(alertMessage);
    } else {
        toastr.error("toastr alert-type " + alertType + " is unknown");
    }
    @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.1/howler.min.js"></script>
<!-- <input type="text" class="form-control" id="nit" name="nit" onkeypress='return validaNumericos(event)' required> -->

<script>
    
    $(function() {
        setInterval(            
            function () 
            {                
                $.get('{{route('get.notifications')}}', function (data) {
                    // alert(data)
                    // if(data > 0)
                    // {
                        // alert(data.length);
                        // var luz = '<i class="voyager-bell text-danger" style="width: 20px; font-size: 1.5em;"></i>'
                        //     luz+= '<span class="badge badge-warning navbar-badge" id="bandeja"></span>'
                        // var luz = '<span class="voyager-bell text-danger" style="font-size: 25px"></span> <span class="badge" style="margin-left: -10px">'+data+'</span>'
                        
                        $('#not').html(data)
                        // $('#bandeja').text(data)
                        // $('#bandeja').text(data.length)
                        // const myTimeout1 = setTimeout(si, 400);
                        
                    // }
                    // else
                    // {
                    //     // var luz = '<i class="voyager-bell text-primary" style="width: 20px; font-size: 1.5em;"></i>'
                    //     //     luz+= '<span class="badge badge-warning navbar-badge" id="bandeja"></span>'
                    //     var luz = '<span class="voyager-bell text-danger" style="font-size: 25px"></span> <span class="badge" style="margin-left: -10px">'+data+'</span>'

                    //     $('#not').html(luz)
                    // }
                    

                    // $('#listadoc').text('Tiene '+data.length + ' Solicitud')
                    // var list = '';
                    // var j = '';
                    // list = '<table class="dataTable table-hover">'
                    // list+='<tbody>'
                    // for (var i = 0; i < data.length; ++i) {
                    //     list+='<tr>'
                    //     list+='<td>'+data[i].name+'</td>'
                    //     list+='<tr>'                            
                    // }
                    // list+='</tbody>'
                    // list +='</table>'
                    // $('#notificaciones').html(list);
                    



                });
            }, 800 //en medio minuto se recargará solo la campana de notificación..
        );
       
    });

    function si()
    {
        var luz = '<i class="voyager-bell text-primary" style="width: 20px; font-size: 1.5em;"></i>'
                            luz+= '<span class="badge badge-warning navbar-badge" id="bandeja"></span>'
        $('#not').html(luz)
    }


    function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
          return true;
        }
        return false;        
    }

</script>
<!-- PARA PONER NUMERICO AL LOS INPUT  -->
<!-- <input type="text" class="form-control" id="nit" name="nit" onkeypress='return validaNumericos(event)' required> -->
<script type="text/javascript">
    function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
          return true;
        }
        return false;        
    }
  </script>
@include('voyager::media.manager')
@yield('javascript')
@stack('javascript')
@if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
    @foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif

</body>
</html>
