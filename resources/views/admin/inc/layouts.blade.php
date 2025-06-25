<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AIWHM-CRM || @yield('page-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/img/favicon-16x16.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/et-line-font/et-line-font.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/simple-lineicon/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        /* General Toastr customization */
        .toast {
            font-size: 12px !important;
            font-family: 'Poppins', sans-serif;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-top: 50px !important;
        }

        .toast-success {
            background-color: #1d622d !important;
            color: #fff !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        .toast-warning {
            background-color: #ffc107 !important;
            color: #000 !important;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            color: #fff !important;
        }

        .toast-message i {
            margin-right: 8px;
        }
    </style>

</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">

        {{-- Main Header --}}
        @include('admin.inc.header')

        {{-- Left Sidebar --}}
        @include('admin.inc.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header sty-one">
                <h1>@yield('page-title')</h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>

                    @php
                        $segment1 = request()->segment(2); // like 'settings'
                        $segment2 = request()->segment(3); // like 'mail'

                        $parentMenu = strtolower(trim(view()->yieldContent('parentMenu')));
                        $pageTitle = trim(view()->yieldContent('page-title'));
                    @endphp

                    {{-- Only show parent if it exists --}}
                    @if (!empty($parentMenu))
                        <li><i class="fa fa-angle-right "></i> {{ ucfirst($parentMenu) }}</li>
                    @endif

                    {{-- Show page title --}}
                    @if (!empty($pageTitle))
                        <li style="margin-left: 5px;"> <i class="fa fa-angle-right"></i> {{ $pageTitle }}</li>
                    @endif
                </ol>
            </div>


            {{-- Main content --}}
            <div class="content">
                @yield('admin-content')
            </div>
        </div>

        {{-- Footer --}}
        @include('admin.inc.footer')

    </div>

    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/bizadmin.js') }}"></script>
    <script src="{{ asset('dist/plugins/jquery-sparklines/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/jquery-sparklines/sparkline-int.js') }}"></script>
    <script src="{{ asset('dist/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('dist/plugins/morris/morris.js') }}"></script>
    <script src="{{ asset('dist/plugins/functions/dashboard1.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>


    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if ($errors->any())
            toastr.error("{{ $errors->first() }}");
        @endif
    </script>


</body>

</html>
