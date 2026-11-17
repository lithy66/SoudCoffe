<!-- Title -->
@yield('title')
<title> @if(!empty($header_title)) {{ $header_title .' - '. $setting->title }} @else @yield('title') @endif </title>
{{--<title> {{!empty($header_title) ? $header_title .' - '. $setting->title: $setting->title}} </title>--}}
<!-- Favicon -->
<link rel="icon" href="{{asset($setting->favicon)}}" type="image/x-icon"/>
{{--<link rel="icon" href="{{URL::asset('assets/admin/img/brand/favicon.png')}}" flavor="image/x-icon"/>--}}

@yield('css')
<!-- Font & Icons css -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css" >
<link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
<link rel="stylesheet" href="{{URL::asset('assets/admin/css/basic-custom.css')}}">
@livewireStyles

@if(App::getLocale() == 'ar')
<!-- Icons css -->
<link href="{{URL::asset('assets/admin/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/admin/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/admin/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/admin/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('assets/admin/css-rtl/sidemenu.css')}}">
<!---notify css-->
<link href="{{URL::asset('assets/admin/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
<!--- Style css -->
<link href="{{URL::asset('assets/admin/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('assets/admin/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('assets/admin/css-rtl/skin-modes.css')}}" rel="stylesheet">
<!---custom css-->
<link href="{{URL::asset('assets/admin/css-rtl/custom.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/admin/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--- Animations css-->
<link href="{{URL::asset('assets/admin/css/animate.css')}}" rel="stylesheet">
@else

    <link href="{{URL::asset('assets/admin/css/icons.css')}}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{URL::asset('assets/admin/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <!--  Right-sidemenu css -->
    <link href="{{URL::asset('assets/admin/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/admin/css/sidemenu.css')}}">
    <!---notify css-->
    <link href="{{URL::asset('assets/admin/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
    <!-- Maps css -->
    <link href="{{URL::asset('assets/admin/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <!--Internal  Nice-select css  -->
    <link href="{{URL::asset('assets/admin/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
    <!-- style css -->
    <link href="{{URL::asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/admin/css/skin-modes.css')}}" rel="stylesheet" />
    <!---custom css-->
    <link href="{{URL::asset('assets/admin/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/sumoselect/sumoselect.css') }}">

@endif
