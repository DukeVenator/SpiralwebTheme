{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Pterodactyl') }} - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="#0e4688">

        @include('layouts.scripts')

        @section('scripts')
		    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
            {!! Theme::css('vendor/select2/select2.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}') !!}
            {!! Theme::css('vendor/animate/animate.min.css?t={cache-version}') !!}

            {!! Theme::css('assets/vendor/font-awesome/css/all.min.css?t={cache-version}') !!}
            {!! Theme::css('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css?t={cache-version}') !!}
            {!! Theme::css('assets/css/theme.css') !!}

            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        @show
	</head>
	<!-- End Head -->

	<body>
		<!-- Header (Topbar) -->
		<header class="u-header">

			<div class="u-header-left">
                <a href="{{ route('index') }}" class="logo">
                    <span class="logo-lg"><img src="/LogoTextTiny.png" style="height: 100%; width: 100%; object-fit: contain"></span>
                </a>
			</div>

			<div class="u-header-middle">
				<a class="js-sidebar-invoker u-sidebar-invoker" href="#!"
				   data-is-close-all-except-this="true"
				   data-target="#sidebar">
					<i class="fa fa-sliders-h u-sidebar-invoker__icon--open"></i>
					<i class="fa fa-times u-sidebar-invoker__icon--close"></i>
				</a>

			</div>

			<div class="u-header-right">
		  	<!-- User Profile -->
				<div class="dropdown ml-2">
				  <a class="link-muted d-flex align-items-center" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
				    <img class="u-avatar--xs img-fluid rounded-circle mr-2" src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160" alt="User Profile">
						<span class="text-dark d-none d-sm-inline-block">
							{{ Auth::user()->name_first }} {{ Auth::user()->name_last }} <small class="fa fa-angle-down text-muted ml-1"></small>
						</span>
				  </a>

				  <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-3" aria-labelledby="dropdownMenuLink" style="width: 260px;">
				  	<div class="card">
							<div class="card-body">
								<ul class="list-unstyled mb-0">
                            @if(Auth::user()->root_admin)
									<li class="mb-4">
										<a class="d-flex align-items-center link-dark" href="{{ route('index') }}">
											<span class="h3 mb-0"><i class="fas fa-server text-muted mr-3"></i></span> Exit Admin Control
										</a>
									</li>
                            @endif
									<li>
										<a class="d-flex align-items-center link-dark" href="{{ route('auth.logout') }}">
											<span class="h3 mb-0"><i class="fas fa-share-square text-muted mr-3"></i></span> @lang('strings.logout')
										</a>
									</li>
								</ul>
							</div>
				  	</div>
				  </div>
				</div>
		  	<!-- End User Profile -->
			</div>
		</header>
		<!-- End Header (Topbar) -->
		<main class="u-main" role="main">
			<!-- Sidebar -->
			<aside id="sidebar" class="u-sidebar">
				<div class="u-sidebar-inner">

					<nav class="u-sidebar-nav">
						<ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
							<!-- Basic admin Sidebar -->
                            <li class="u-sidebar-nav-menu__item">
									<i class="fa fa-layer-group u-sidebar-nav-menu__item-icon u-sidebar-nav-menu__item-title"></i>
									<span class="u-sidebar-nav-menu__item-title">BASIC ADMINISTRATION</span>
							</li>

							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'admin.index' ?: 'active' }}" href="{{ route('admin.index') }}">
									<i class="fa fa-home u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Overview</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'admin.statistics' ?: 'active' }}" href="{{ route('admin.statistics') }}">
									<i class="fa fa-tachometer-alt u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Statistics</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.settings') ?: 'active' }}" href="{{ route('admin.settings') }}">
									<i class="fa fa-wrench u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Settings</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.api') ?: 'active' }}" href="{{ route('admin.api.index') }}">
									<i class="fa fa-gamepad u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Application API</span>
								</a>
							</li>
							<!-- End Basic Admin Sidebar -->
							<hr>
							<!-- Management Sidebar -->
                            <li class="u-sidebar-nav-menu__item">
									<i class="fa fa-layer-group u-sidebar-nav-menu__item-icon u-sidebar-nav-menu__item-title"></i>
									<span class="u-sidebar-nav-menu__item-title">MANAGEMENT</span>
							</li>

							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.databases') ?: 'active' }}" href="{{ route('admin.databases') }}">
									<i class="fa fa-database u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Databases</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.locations') ?: 'active' }}" href="{{ route('admin.locations') }}">
									<i class="fa fa-globe u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Locations</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.nodes') ?: 'active' }}" href="{{ route('admin.nodes') }}">
									<i class="fa fa-sitemap u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Nodes</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.servers') ?: 'active' }}" href="{{ route('admin.servers') }}">
									<i class="fa fa-server u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Servers</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.users') ?: 'active' }}" href="{{ route('admin.users') }}">
									<i class="fa fa-users u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Users</span>
								</a>
							</li>
							<!-- End Management Sidebar -->
							<hr>
							<!-- Management Sidebar -->
                            <li class="u-sidebar-nav-menu__item">
									<i class="fa fa-layer-group u-sidebar-nav-menu__item-icon u-sidebar-nav-menu__item-title"></i>
									<span class="u-sidebar-nav-menu__item-title">SERVICE MANAGEMENT</span>
							</li>

							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.nests') ?: 'active' }}" href="{{ route('admin.nests') }}">
									<i class="fa fa-th-large u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Nests</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'admin.packs') ?: 'active' }}" href="{{ route('admin.packs') }}">
									<i class="fa fa-archive u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">Packs</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</aside>
			<!-- End Sidebar -->
			<div class="u-content">
				<div class="u-body">
					<div class=" mb-4">
					@yield('content-header')
                    <div class="row">
                        <div class="col-xs-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @lang('base.validation_error')<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach (Alert::getMessages() as $type => $messages)
                                @foreach ($messages as $message)
                                    <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
                                        {!! $message !!}
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    @yield('content')
					</div>
				</div>

				<!-- Footer -->
				<footer class="u-footer d-md-flex align-items-md-center text-center text-md-left text-muted text-muted">
					<p class="h5 mb-0 ml-auto">
                    Copyright &copy; 2018 - {{ date('Y') }} <a href="https://spiralcrafters.com/">Spiralcrafters.com</a>. Huge Shoutout to the Terra team: <a href="To do">Terra</a>
					</p>
				</footer>
				<!-- End Footer -->
			</div>
		</main>
        @section('footer-scripts')

            {!! Theme::js('js/keyboard.polyfill.js?t={cache-version}') !!}
            <script>keyboardeventKeyPolyfill.polyfill();</script>
            {!! Theme::js('js/laroute.js?t={cache-version}') !!}

		<!-- From Theme -->
            {!! Theme::js('assets/vendor/jquery/dist/jquery.min.js?t={cache-version}') !!}
            {!! Theme::js('assets/vendor/jquery-migrate/jquery-migrate.min.js?t={cache-version}') !!}
            {!! Theme::js('assets/vendor/popper.js/dist/umd/popper.min.js?t={cache-version}') !!}
            {!! Theme::js('assets/vendor/bootstrap/bootstrap.min.js?t={cache-version}') !!}

            {!! Theme::js('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js?t={cache-version}') !!}
            {!! Theme::js('assets/js/sidebar-nav.js') !!}
            {!! Theme::js('assets/js/main.js?t={cache-version}') !!}
            {!! Theme::js('assets/js/dashboard-page-scripts.js?t={cache-version}') !!}
		<!-- End From Theme -->

            {!! Theme::js('vendor/sweetalert/sweetalert.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/socketio/socket.io.v203.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/bootstrap-notify/bootstrap-notify.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/select2/select2.full.min.js?t={cache-version}') !!}
            {!! Theme::js('js/admin/functions.js?t={cache-version}') !!}
            {!! Theme::js('js/autocomplete.js?t={cache-version}') !!}

            @if(Auth::user()->root_admin)
                <script>
                    $('#logoutButton').on('click', function (event) {
                        event.preventDefault();

                        var that = this;
                        swal({
                            title: 'Do you want to log out?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Log out'
                        }, function () {
                            window.location = $(that).attr('href');
                        });
                    });
                </script>
            @endif
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                })
            </script>
        @show
	</body>
</html>
