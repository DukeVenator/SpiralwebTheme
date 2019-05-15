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
            {!! Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}') !!}
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
										<a class="d-flex align-items-center link-dark" href="{{ route('admin.index') }}">
											<span class="h3 mb-0"><i class="fas fa-cogs text-muted mr-3"></i></span> @lang('strings.admin_cp')
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
							<!-- Account Sidebar -->
                            <li class="u-sidebar-nav-menu__item">
									<i class="fa fa-layer-group u-sidebar-nav-menu__item-icon u-sidebar-nav-menu__item-title"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.account.header')</span>
							</li>

							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'account' ?: 'active' }}" href="{{ route('account') }}">
									<i class="fa fa-user u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.account.my_account')</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'account.security' ?: 'active' }}" href="{{ route('account.security') }}">
									<i class="fa fa-lock u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.account.security_controls')</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ (Route::currentRouteName() !== 'account.api' && Route::currentRouteName() !== 'account.api.new') ?: 'active' }}" href="{{ route('account.api') }}">
									<i class="fa fa-code u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.account.api_access')</span>
								</a>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'index' ?: 'active' }}" href="{{ route('index') }}">
									<i class="fa fa-server u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.account.my_servers')</span>
								</a>
							</li>
							<!-- End Account Sidebar -->
							<hr>
							<!-- Server Sidebar -->
                        @if (isset($server->name) && isset($node->name))
                            <li class="u-sidebar-nav-menu__item">
									<i class="fa fa-layer-group u-sidebar-nav-menu__item-icon u-sidebar-nav-menu__item-title"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.header')</span>
							</li>

							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'server.index' ?: 'active' }}" href="{{ route('server.index', $server->uuidShort) }}">
									<i class="fa fa-terminal u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.console')</span>
								</a>
							</li>
                            @can('list-files', $server)
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'server.files') ?: 'active' }}" href="{{ route('server.files.index', $server->uuidShort) }}">
									<i class="fa fa-file u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.file_management')</span>
								</a>
							</li>
                            @endcan
                            @if(Gate::allows('view-startup', $server) || Gate::allows('access-sftp', $server) ||  Gate::allows('view-allocations', $server))
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'server.settings') ?: 'active' }}" href="#!"
								   data-target="#subMenu1">
									<i class="fas fa-cog u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.configuration')</span>
									<i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
									<span class="u-sidebar-nav-menu__indicator"></span>
								</a>

								<ul id="subMenu1" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">
									<!-- Components -->
									<li class="u-sidebar-nav-menu__item">
										<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'server.settings.name' ?: 'active' }}" href="{{ route('server.settings.name', $server->uuidShort) }}">
											<span class="u-sidebar-nav-menu__item-icon"><i class="fa fa-address-card"></i></span>
											<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.server_name')</span>
										</a>
									</li>
									<li class="u-sidebar-nav-menu__item">
										<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'server.settings.allocation' ?: 'active' }}" href="{{ route('server.settings.allocation', $server->uuidShort) }}">
											<span class="u-sidebar-nav-menu__item-icon"><i class="fa fa-sign"></i></span>
											<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.port_allocations')</span>
										</a>
									</li>
									<li class="u-sidebar-nav-menu__item">
										<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'server.settings.sftp' ?: 'active' }}" href="{{ route('server.settings.sftp', $server->uuidShort) }}">
											<span class="u-sidebar-nav-menu__item-icon"><i class="fa fa-plug"></i></span>
											<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.sftp_settings')</span>
										</a>
									</li>
									<li class="u-sidebar-nav-menu__item">
										<a class="u-sidebar-nav-menu__link {{ Route::currentRouteName() !== 'server.settings.startup' ?: 'active' }}" href="{{ route('server.settings.startup', $server->uuidShort) }}">
											<span class="u-sidebar-nav-menu__item-icon"><i class="fa fa-play"></i></span>
											<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.startup_parameters')</span>
										</a>
									</li>
									<!-- End Components -->
								</ul>
							</li>
                            @endif
                            @can('list-subusers', $server)
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'server.subusers') ?: 'active' }}" href="{{ route('server.subusers', $server->uuidShort) }}">
									<i class="fa fa-users u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.subusers')</span>
								</a>
							</li>
                            @endcan
                            @can('list-schedules', $server)
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'server.schedules') ?: 'active' }}" href="{{ route('server.schedules', $server->uuidShort) }}">
									<i class="fa fa-clock u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.schedules')</span>
									<span class="pull-right-container ml-auto">
											<span class="badge badge-dark pull-right">{{ \Pterodactyl\Models\Schedule::select('id')->where('server_id', $server->id)->where('is_active', 1)->count() }}</span>
									</span>

								</a>
							</li>
                            @endcan
                            @can('view-databases', $server)
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link {{ ! starts_with(Route::currentRouteName(), 'server.databases') ?: 'active' }}" href="{{ route('server.databases.index', $server->uuidShort) }}">
									<i class="fa fa-database u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.databases')</span>
								</a>
							</li>
                            @endcan
							<hr>
                            @if(Auth::user()->root_admin)
                            <li class="u-sidebar-nav-menu__item">
									<i class="fa fa-layer-group u-sidebar-nav-menu__item-icon u-sidebar-nav-menu__item-title"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.admin_header')</span>
							</li>
							<li class="u-sidebar-nav-menu__item">
								<a class="u-sidebar-nav-menu__link" href="{{ route('admin.servers.view', $server->id) }}">
									<i class="fa fa-cogs u-sidebar-nav-menu__item-icon"></i>
									<span class="u-sidebar-nav-menu__item-title">@lang('navigation.server.admin')</span>
								</a>
							</li>
                            @endif
                        @endif
							<!-- End Server Sidebar -->
						</ul>
					</nav>
				</div>
			</aside>
			<!-- End Sidebar -->

			<div class="u-content">
				<div class="u-body">
					<div class=" mb-4">
					@yield('content-header')

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
        @show
	</body>
</html>
