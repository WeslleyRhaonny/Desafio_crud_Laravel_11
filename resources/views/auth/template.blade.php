<!DOCTYPE html>
<html 
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
    class="light-style layout-menu-fixed" 
    dir="ltr" 
    data-theme="theme-default"
    data-assets-path="{{ asset('lib/vuexy/') }}" 
    data-template="horizontal-menu-template"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    
    <title>Stalo - Cadastro de transações</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <!-- Jquery -->
    <script src="{{ asset('lib/jquery/jquery-3.7.1.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('themes/def-theme.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/animate-css/animate.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/css/pages/page-auth.css') }}" />
    <link rel="stylesheet" href="{{ asset('authenticator/css/login.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('lib/vuexy/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('lib/vuexy/js/config.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('themes/cards.css') }}">

    @yield('styles')
</head>

<body style="height: 100vh;">

    <div class="authentication-wrapper authentication-cover authentication-bg h-100">
        <div class="authentication-inner row m-0 m-xs-0 h-100" style="--bs-gutter-x: none;">
            
            <div class="auth-banner-cover d-none d-lg-flex col-lg-8">
                <div class="auth-bg-cover-custom d-flex justify-content-center align-items-center">
                    <img 
                        src="{{ asset('authenticator/login_banner.png') }}" 
                        alt="auth-login-cover"
                        class="img-fluid auth-illustration h-100"
                        data-app-light-img="{{ asset('authenticator/login_banner.png') }}"
                        data-app-dark-img="{{ asset('authenticator/login_banner.png') }}" 
                    />
                </div>
            </div>

            <div class="d-flex col-12 col-lg-4 align-items-center p-sm-5">
                <div class="w-px-400 mx-auto h-100">
                    
                    <div class="d-flex justify-content-center mb-5">
                        <a href="" class="">
                            <img class="app-brand-logo" width="200" height="100" src="{{ asset('stalo_logo.png') }}"
                                alt="Stalo Logo">
                        </a>
                    </div>

                    <h2 class="mb-1 fw-bold text-primary text-center"> Login</h2>
                    <h5 class="fw-bold text-center mb-4">Sistema de cadastro de transações</h5>

                    @if($errors->any())
                    <div class="col-md mb-4 mb-md-0">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{$error}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    @session('success')
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endsession

                    @yield('main')

                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('lib/vuexy/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('lib/vuexy/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('lib/vuexy/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
  
    <!-- Flat Picker -->
    <script src="{{ asset('lib/vuexy/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('lib/vuexy/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('lib/vuexy/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('rh/list-all/tables-datatables-advanced.js') }}"></script>

    @yield('scripts')
</body>

</html>
