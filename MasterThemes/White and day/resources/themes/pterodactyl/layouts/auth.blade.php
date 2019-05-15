{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Pterodactyl') }} - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="#0e4688">

        @section('scripts')
	    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

            {!! Theme::css('assets/vendor/font-awesome/css/all.min.css?t={cache-version}') !!}
            {!! Theme::css('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css?t={cache-version}') !!}
            {!! Theme::css('assets/css/theme.css') !!}

            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        @show
    </head>
<body>
		<main class="container-fluid w-100" role="main">
			<div class="row mnh-100vh">
				<div class="col-lg-6 d-flex flex-column justify-content-center align-items-center bg-white mnh-100vh">

					<div class="u-login-form mt-5 mb-0">
							<div class="mb-5 mt-5 text-center">
								<h1 class="h2">{{ config('app.name', 'Pterodactyl') }}</h1>
								<p class="small">Login to the panel with your registered email address and password.</p>
							</div>

                        @yield('content')

						<p class="small login-copyright text-center pt-5">
                            Copyright &copy; 2018 - {{ date('Y') }} <a href="https://spiralcrafters.com/">Spiralcrafters.com</a>. Huge Shoutout to the Terra team: <a href="To do">Terra</a>.<br />
                        </p>
					</div>

					<div class="u-login-form text-muted py-3 mt-auto">
						<small>
						      <strong><i class="fa fa-fw {{ $appIsGit ? 'fa-git-square' : 'fa-code-branch' }}"></i></strong> {{ $appVersion }}<br />
                              <strong><i class="fa fa-fw fa-clock"></i></strong> {{ round(microtime(true) - LARAVEL_START, 3) }}s
			            </small>
					</div>
				</div>

				<div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center bg-light">
					    {!! Theme::img('assets/svg/mockups/mockup.svg', 'alt', 'img-fluid position-relative u-z-index-3 mx-5') !!}

					<figure class="u-shape u-shape--top-right u-shape--position-5">
					    {!! Theme::img('assets/svg/shapes/shape-1.svg') !!}
					</figure>
					<figure class="u-shape u-shape--center-left u-shape--position-6">
					    {!! Theme::img('assets/svg/shapes/shape-2.svg') !!}
					</figure>
					<figure class="u-shape u-shape--center-right u-shape--position-7">
					    {!! Theme::img('assets/svg/shapes/shape-3.svg') !!}
					</figure>
					<figure class="u-shape u-shape--bottom-left u-shape--position-8">
					    {!! Theme::img('assets/svg/shapes/shape-4.svg') !!}
					</figure>
				</div>
			</div>
		</main>
	</body>
</html>
