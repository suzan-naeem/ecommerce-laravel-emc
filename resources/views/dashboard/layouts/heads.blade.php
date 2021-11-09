<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ asset('assets_' . app()->getLocale() . '/images/favicon_1.ico') }}">

        <title>@lang('dashboard.dashboardTitle')</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Changa:wght@400;700&display=swap" rel="stylesheet">
        <style>
            * {
                font-family: 'Changa', sans-serif;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Changa', sans-serif !important;
            }
        </style>

{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />--}}

{{--        <!-- Plugins css -->--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">--}}

{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>--}}

{{--        <!--Morris Chart CSS -->--}}
{{--        <link rel="stylesheet" href="{{ asset('assets_' . app()->getLocale() . '/plugins/morris/morris.css') }}">--}}

        <link href="{{ asset('assets_' . app()->getLocale() . '/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_' . app()->getLocale() . '/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_' . app()->getLocale() . '/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_' . app()->getLocale() . '/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_' . app()->getLocale() . '/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_' . app()->getLocale() . '/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets_' . app()->getLocale() . '/css/responsive.css') }}" rel="stylesheet" type="text/css" />
{{--        <script src="{{ asset('assets_' . app()->getLocale() . '/js/modernizr.min.js') }}"></script>--}}

{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/dropzone/basic.min.css') }}" rel="stylesheet" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />--}}
{{--        <link href="{{ asset('assets_' . app()->getLocale() . '/fullcalender/fullcalendar.css') }}" rel="stylesheet" />--}}

        <script>
            function logout(e) {
                e.preventDefault();
                document.getElementById('logout').submit();
            }
        </script>
    </head>

