<!--begin::Head-->
@php
    if(file_exists( public_path().'/upload/systemsetting/'.get_system_setting_detail()->favicon_icon) && get_system_setting_detail()->favicon_icon != ''){
        $feviconIcon = url("public/upload/systemsetting/".get_system_setting_detail()->favicon_icon);
    }else{
        $feviconIcon = url("public/upload/systemsetting/logo-new.png");
    }
@endphp
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="{{  Config::get('constants.SYSTEM_NAME'); }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{  asset('public/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{  asset('public/backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{  asset('public/backend/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{  $feviconIcon }}" />

    <link href="{{  asset('public/backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <style>
        :root {
            --theme-color: #f4911e !important;
        }
    </style> --}}
    @php
    $systemsetting = get_system_setting_detail();
    @endphp
    <style>

        :root {
            --theme-color: {{ $systemsetting['theme_color'] }};
        }
        :root {
            --sidebar-color: {{ $systemsetting['sidebar_color'] }};
        }
        :root {
            --sidebar-menu-font-color: {{ $systemsetting['sidebar_menu_color'] }};
        }

        .aside-menu {
            background-color: {{ $systemsetting['sidebar_color'] }} !important;
        }

        .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link {
            background-color: {{ $systemsetting['sidebar_menu_active_color'] }} !important;
        }

        .aside,.brand {
            background-color: {{ $systemsetting['sidebar_color'] }} !important;
        }


        .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
            color:{{ $systemsetting['sidebar_menu_color'] }} !important ;
        }

        .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-link .menu-text {
            color:white !important  ;
        }

        .aside-menu .menu-nav > .menu-item > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item > .menu-link .menu-icon.svg-icon svg g [fill] {
            transition: fill 0.3s ease;
            fill: {{ $systemsetting['sidebar_menu_color'] }} !important ;
        }
        .svg-icon svg g [fill] {
            transition: fill 0.3s ease;
            fill: {{ $systemsetting['sidebar_menu_color'] }} !important ;
        }

        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link {
            background-color: {{ $systemsetting['sidebar_menu_active_color'] }} !important;
        }

        .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link {
            background-color: {{ $systemsetting['sidebar_menu_active_color'] }} !important;
        }

        .aside-menu .menu-nav>.menu-item .menu-submenu .menu-item.menu-item-active>.menu-heading, .aside-menu .menu-nav>.menu-item .menu-submenu .menu-item.menu-item-active>.menu-link {
            background-color: {{ $systemsetting['sidebar_menu_active_color'] }} !important;
        }


        .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link{
            color: white !important;
            background-color: {{ $systemsetting['sidebar_menu_active_color'] }} !important;
        }

        .aside-menu .menu-nav > .menu-item > .menu-heading .menu-arrow, .aside-menu .menu-nav > .menu-item > .menu-link .menu-arrow {
            color:{{ $systemsetting['sidebar_menu_color'] }}  ;
        }
         .brand {
            background-color: {{ $systemsetting['sidebar_navbar_background_color'] }} !important  ;
        }
        .brand {
             color:{{ $systemsetting['sidebar_navbar_font_color'] }} !important  ;
        }
        .align-items-stretch {
            background-color: {{ $systemsetting['header_navbar_background_color'] }} !important  ;

        }
        .align-items-stretch {
            color: {{ $systemsetting['header_navbar_font_color'] }} !important  ;

        }
        .text-dark-50 {
            color: {{ $systemsetting['header_navbar_font_color'] }} !important  ;

        }
        .font-size-base {
            color: {{ $systemsetting['header_navbar_font_color'] }} !important  ;
            /* abc */
        }


        .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-text{
            color: #ffffff !important;
        }
        .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link {
            background-color:{{ $systemsetting['sidebar_menu_active_color'] }} !important;
        }
        /* style */
    </style>
    @if (!empty($css))
        @foreach ($css as $value)
            @if(!empty($value))
                <link rel="stylesheet" href="{{ asset('public/backend/css/customcss/'.$value) }}">
            @endif
        @endforeach
    @endif


    @if (!empty($plugincss))
        @foreach ($plugincss as $value)
            @if(!empty($value))
                <link rel="stylesheet" href="{{ asset('public/backend/'.$value) }}">
            @endif
        @endforeach
    @endif

    <script>
        var baseurl = "{{ asset('/') }}";
        var date_formate = "dd-M-yyyy";
        var decimal_point = "{{ Config::get('constants.DECIMAL_POINT') }}";
    </script>

</head>
<!--end::Head-->
