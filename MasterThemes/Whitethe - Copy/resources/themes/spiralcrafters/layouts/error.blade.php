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
    <body class="hold-transition">
        <div class="wrapper">
		<!-- Header (Topbar) -->
		<header class="u-header">

			<div class="u-header-left">
                <a href="{{ route('index') }}" class="logo">
									<span class="logo-lg"><img src="/LogoTextTiny.png" style="height: 100%; width: 100%; object-fit: contain"></span>
                </a>
			</div>

		</header>
		<!-- End Header (Topbar) -->

            <div class="content-wrapper" style="margin-left: auto;">
                <section class="content-header text-center">
                    @yield('content-header')
                </section>
                <section class="content text-center">
                    @yield('content')
                </section>
            </div>
				<!-- Footer -->
				<footer class="u-footer d-md-flex align-items-md-center text-center text-md-left text-muted text-muted">
					<p class="h5 mb-0 ml-auto">
                    Copyright &copy; 2018 - {{ date('Y') }} <a href="https://spiralcrafters.com/">Spiralcrafters.com</a>. Huge Shoutout to the Terra team: <a href="To do">Terra</a>
					</p>
				</footer>
				<!-- End Footer -->
        </div>
        @section('footer-scripts')
            {!! Theme::js('js/laroute.js?t={cache-version}') !!}
            {!! Theme::js('vendor/jquery/jquery.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/bootstrap/bootstrap.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/adminlte/app.min.js?t={cache-version}') !!}
        @show
    </body>
</html>
