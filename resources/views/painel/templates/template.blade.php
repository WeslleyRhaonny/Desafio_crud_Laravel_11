<!DOCTYPE html>

<html 
    lang="pt-br" 
    class="light-style layout-menu-fixed" 
    dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('lib/vuexy/') }}" 
    data-template="horizontal-menu-template">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    
    <title>Sistema de Cadastro de transações</title>

    <!-- Jquery --> 
    <script src="{{ asset('lib/jquery/jquery-3.7.1.min.js') }}"></script>

    <!-- Inclua o jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

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
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/css/pages/cards-advance.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/vuexy/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('lib/vuexy/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('lib/vuexy/js/config.js') }}"></script>

    <!-- Complements -->
    <link rel="stylesheet" href="{{ asset('themes/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/overflow.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/forms.css') }}">
    
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">
    
    @yield('styles')

    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            background-color: #343a40; /* Fundo escuro */
            color: #056422;
            overflow-y: auto;
        }
        
        .sidebar-logo {
            margin-bottom: 20px;
        }
        
        .sidebar-menu {
            padding: 0;
            list-style: none;
            margin: 0;
        }
        
        .sidebar-menu .sidebar-link {
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            color: #056422;
            transition: background-color 0.2s ease;
        }
        
        .sidebar-menu .sidebar-link:hover {
            background-color: #495057; /* Efeito hover */
        }
        
        .sidebar-menu .sidebar-link i {
            margin-right: 10px;
        }
        
        .layout-page {
            margin-left: 250px; /* Compensa a largura da sidebar */
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                width: 100%;
                height: auto;
                z-index: 1050;
            }
            .layout-page {
                margin-left: 0;
            }
        }    
    </style>
</head>

<body>

    <div class="preloader" id="preloader">
        <img src="{{ asset('stalo_logo.png') }}" alt="">
        <div class="preloader-body spinner-border border-5 text-primary" role="status">
        </div>
    </div>

	<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
		<div class="layout-container">
			<!-- Navbar -->

			<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-fluid">
					<div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                        <a href="" class="app-brand-link gap-2">
                            <img class="app-brand-logo" width="190" height="45"
                                src="{{ asset('stalo_logo.png') }}" alt="Stalo Logo">
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="ti ti-x ti-sm align-middle"></i>
                        </a>

                        <div class="d-flex justify-content-start align-items-center text-align-center w-100 ms-3">
                            <h2 class="text-primary" style="height: fit-content; margin: 0; padding: 0;">
                                <strong>Sistema de Cadastro de Transações</strong>
                            </h2>
                        </div>
                    </div>
                    

					<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
						<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
							<i class="ti ti-menu-2 ti-sm"></i>
						</a>
					</div>
					<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            @include('painel.templates.components.iconized-menu')

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src=" {{asset('stalo_logo2.png')}} " alt="" class="h-100 w-100 rounded-circle" />
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    {{-- {% include 'globals/menus/profile-menu.html') }} --}}
                                    @include('painel.templates.components.profile-menu')
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
				</div>
			</nav>

			<!-- / Navbar -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Menu -->
					<aside id="layout-menu"
						class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
						<div class="container-fluid d-flex h-100">
							<ul class="menu-inner">
                                @include('painel.templates.components.main-menu')
							</ul>
						</div>
					</aside>
					<!-- / Menu -->

                    <!-- Sidebar -->
                    <aside id="layout-sidebar" class="sidebar bg-menu-theme">
                        <div class="sidebar-header d-flex align-items-center justify-content-center py-4">
                            <a href="/" class="d-flex align-items-center text-decoration-none">
                                <img src="{{ asset('stalo_logo.png') }}" alt="Logo" class="sidebar-logo" width="120">
                            </a>
                        </div>
                        <ul class="sidebar-menu list-unstyled">
                            <li><a href="/painel" class="sidebar-link"><i class="ti ti-list"></i> Transações</a></li>
                        </ul>
                    </aside>
                    <!-- /Sidebar -->

					<!-- Content -->

					<div class="container-fluid flex-grow-1 container-p-y w-100">
						@yield('main')
					</div>
					<!--/ Content -->

					
					<div class="content-backdrop fade"></div>
				</div>
				<!--/ Content wrapper -->
			</div>

			<!--/ Layout container -->
		</div>
	</div>

	<!-- Overlay -->
	<div class="layout-overlay layout-menu-toggle"></div>

	<!-- Drag Target Area To SlideIn Menu On Small Screens -->
	<div class="drag-target"></div>

	<!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script>
        var loader = document.getElementById('preloader');

        window.addEventListener('load', function () {
            loader.style.display = 'none';
        })
    </script>
    <script src="{{ asset('lib/vuexy/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('lib/vuexy/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('lib/vuexy/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('lib/vuexy/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('lib/vuexy/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <!-- Flat Picker -->
    <script src="{{ asset('lib/vuexy/vendor/libs/flatpickr/flatpickr.js') }}"></script>
   
    <!-- Main JS -->
    <script src="{{ asset('lib/vuexy/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('lib/vuexy/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('rh/list-all/tables-datatables-advanced.js') }}"></script>

    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
   
    <!-- messages -->
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Erro!',
                html: '<ul>' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Bom Trabalho!',
                html: '{{ session('success') }}',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
            });
        </script>
    @endif

    @yield('scripts')



</body>

</html>