<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title>{{ isset($info) ? $info->site_name : '' }} - @yield('title') </title>


        {{-- @if(!empty($site->url_logo)) --}}
            <link rel="shortcut icon" href="{{ asset('Back/images/logo/appLogo/'.$info->app_logo) }}" type="image/x-icon">
        {{-- @else
            <link rel="icon" type="image/x-icon" href="{{ asset('/Back') }}/assets/img/favicon.ico"/>
        @endif --}}

{{--        <link rel="icon" type="image/x-icon" href="{{ asset('/Back') }}/assets/img/favicon.ico"/>--}}
        <link href="{{ asset('/Back') }}/assets/css/loader.css" rel="stylesheet" type="text/css" />
        <script src="{{ asset('/Back') }}/assets/js/loader.js"></script>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="{{ asset('/Back') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/Back') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('/Back') }}/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/table/datatable/dt-global_style.css">
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="{{ asset('/Back') }}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/texteditor/jquery-te-1.4.0.css">
        <script src="{{asset('/Back')}}/texteditor/jquery-te-1.4.0.min.js"></script>

        <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @yield('style')

    </head>
    <body>


        <script>
            @if(Session::has('message'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.success("{{ session('message') }}");
            @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.error("{{ session('error') }}");
            @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.info("{{ session('info') }}");
            @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.warning("{{ session('warning') }}");
            @endif
          </script>

    <!-- BEGIN LOADER -->
    {{--<div id="load_screen">
        <div class="loader">
            <div class="loader-section">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>--}}
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('BackEnd.include.header')
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>@yield('title')</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto ">
                {{--<li class="nav-item more-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Settings</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                            <a class="dropdown-item" data-value="Settings" href="javascript:void(0);">Settings</a>
                            <a class="dropdown-item" data-value="Mail" href="javascript:void(0);">Mail</a>
                            <a class="dropdown-item" data-value="Print" href="javascript:void(0);">Print</a>
                            <a class="dropdown-item" data-value="Download" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" data-value="Share" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </li>--}}
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
    @include('BackEnd.include.sidebar')
    <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            @yield('section')


            <div class="footer-wrapper" style=" background-color: #0e1726; ">
                <div class="footer-section f-section-1">
                    <p class="" style="color: white;">Copyright © {{ now()->year }}, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <a target="_blank" style="color: white;" href="https://youtube.com/withusbuddy" title="Shamim Hossain">With Us Buddy</a>
                </div>
            </div>

        </div>
        <!--  END CONTENT AREA  -->

    </div>

<script>
    $('.jqte-test').jqte();
</script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('/Back') }}/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

    <!-- END MAIN CONTAINER -->
    <script src="{{ asset('/Back') }}/js/jquery.min.js"></script>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/Back') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('/Back') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('/Back') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('/Back') }}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('/Back') }}/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });


        function closeImage(valu)
        {
            $('#image'+valu).remove()
        }



    </script>

    <script src="{{ asset('/Back') }}/assets/js/custom.js"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('/Back') }}/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('/Back') }}/plugins/table/datatable/datatables.js"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-section-sm-start justify-section-center'l><'col-12 col-sm-6 d-flex justify-section-sm-end justify-section-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-section-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
    <script src="{{ asset('/Back') }}/assets/js/scrollspyNav.js"></script>
    <script src="{{ asset('/Back') }}/plugins/select2/select2.min.js"></script>
    <script src="{{ asset('/Back') }}/plugins/select2/custom-select2.js"></script>
    @yield('script')
    <!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>

