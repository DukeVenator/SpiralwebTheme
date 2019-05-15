{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    {{ trans('server.index.title', [ 'name' => $server->name]) }}
@endsection

@section('scripts')
    @parent
    {!! Theme::css('css/terminal.css') !!}
@endsection

@section('content-header')
    <h1>@lang('server.index.header')<small>@lang('server.index.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.servers')</a></li>
        <li class="active">{{ $server->name }}</li>
    </ol>
@endsection

@section('content')
					<div class="row dynamic-update" data-server="{{ $server->uuidShort }}">
						<div class="col-sm-6 col-xl-3 mb-4">
							<div class="card">
								<div class="card-body media align-items-center px-xl-3">
									<div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
										<div class="u-doughnut__label text-info"><i class="fa fa-address-card text-info ml-1"></i></div>
									</div>

									<div class="media-body">
										<h5 class="h6 text-muted text-uppercase mb-2">
											Server Name
										</h5>
										<span class="h2 mb-0">{{ $server->name }}</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3 mb-4">
							<div class="card">
								<div class="card-body media align-items-center px-xl-3">
									<div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
										<div class="u-doughnut__label text-info"><i class="fa fa-memory text-danger ml-1"></i></div>
									</div>

									<div class="media-body">
										<h5 class="h6 text-muted text-uppercase mb-2">
											Memory
										</h5>
										<span class="h2 font-weight-bold mb-0" data-action="memory">--</span><span class="h2 font-weight-bold mb-0"> / {{ $server->memory === 0 ? '∞' : $server->memory }} MB</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3 mb-4">
							<div class="card">
								<div class="card-body media align-items-center px-xl-3">
									<div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
										<div class="u-doughnut__label text-info"><i class="fa fa-microchip text-success ml-1"></i></div>
									</div>

									<div class="media-body">
										<h5 class="h6 text-muted text-uppercase mb-2">
											CPU
										</h5>
										<span class="h2 font-weight-bold mb-0" data-action="cpu" data-cpumax="{{ $server->cpu }}">--</span><span class="h2 font-weight-bold mb-0"> %</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3 mb-4">
							<div class="card">
								<div class="card-body media align-items-center px-xl-3">
									<div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
										<div class="u-doughnut__label text-info"><i class="fa fa-hdd text-primary ml-1"></i></div>
									</div>

									<div class="media-body">
										<h5 class="h6 text-muted text-uppercase mb-2">
											Disk
										</h5>
										<span class="h2 font-weight-bold mb-0" data-action="disk">--</span><span class="h2 font-weight-bold mb-0"> MB</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Doughnut Chart -->

					
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body position-relative">
                <div id="terminal" style="width:100%;"></div>
                <div id="terminal_input" class="form-group no-margin">
                    <div class="input-group">
                        <div class="input-group-addon terminal_input--prompt">container:~/$</div>
                        <input type="text" class="form-control terminal_input--input">
                    </div>
                </div>
                <div id="terminalNotify" class="terminal-notify">
                    <i class="fa fa-bell"></i>
                </div>
            </div>
            <div class="box-footer text-center">
                @can('power-start', $server)<button class="btn btn-success disabled" data-attr="power" data-action="start">Start</button>@endcan
                @can('power-restart', $server)<button class="btn btn-primary disabled" data-attr="power" data-action="restart">Restart</button>@endcan
                @can('power-stop', $server)<button class="btn btn-danger disabled" data-attr="power" data-action="stop">Stop</button>@endcan
                @can('power-kill', $server)<button class="btn btn-danger disabled" data-attr="power" data-action="kill">Kill</button>@endcan
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Memory Usage</h3>
            </div>
            <div class="box-body">
                <canvas id="chart_memory" style="max-height:300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">CPU Usage</h3>
            </div>
            <div class="box-body">
                <canvas id="chart_cpu" style="max-height:300px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/ansi/ansi_up.js') !!}
    {!! Theme::js('js/frontend/server.socket.js') !!}
    {!! Theme::js('vendor/mousewheel/jquery.mousewheel-min.js') !!}
    {!! Theme::js('js/frontend/console.js') !!}
    {!! Theme::js('vendor/chartjs/chart.min.js') !!}
    {!! Theme::js('vendor/jquery/date-format.min.js') !!}
    @if($server->nest->name === 'Minecraft' && $server->nest->author === 'support@pterodactyl.io')
        {!! Theme::js('js/plugins/minecraft/eula.js') !!}
    @endif
    {!! Theme::js('js/frontend/serverlist.js') !!}
@endsection
