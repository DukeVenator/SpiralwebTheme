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
                <div id="terminalNotify" class="terminal-notify hidden">
                    <i class="fa fa-bell"></i>
                </div>
            </div>
            <div class="box-footer text-center">
                @can('power-start', $server)<button class="btn btn-success disabled" data-attr="power" data-action="start">Start</button>@endcan
                @can('power-restart', $server)<button class="btn btn-primary disabled" data-attr="power" data-action="restart">Restart</button>@endcan
                @can('power-stop', $server)<button class="btn btn-danger disabled" data-attr="power" data-action="stop">Stop</button>@endcan
                @can('power-kill', $server)<button class="btn btn-danger disabled" data-attr="power" data-action="kill">Kill</button>@endcan
                @if($server->nest_id === 4 || $server->nest_id === 2)
                <button class="btn btn-primary" data-toggle="modal" data-target="#PlayerList">Player List</button>
			    @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="PlayerList" tabindex="-1" role="dialog" aria-labelledby="PlayerListTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="PlayerListTitle">Players</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <table class="modal-body table" id="player_list">
                <tbody>
                 <tr>
                    <th class='text-center'>Name</th>
                    <th class='text-center'>Score</th>
                    <th class='text-center'>Time</th>
                 </tr>
                @foreach($players as $ply)
				<tr>
                    <td class='text-center'>{{$ply['Name']}}</td>
                    <td class='text-center'>{{$ply['Frags']}}</td>
                    <td class='text-center'>{{gmdate("H:i:s", $ply['Time'])}}</td>
                  </tr>
				@if($i++ == 10)
					@break
				@endif
				@endforeach
                </tbody>
              </table>
      <div class="modal-footer">
        <a href="{{ route('server.playerlist', $server->uuidShort) }}" class="btn btn-primary">Full List</a>
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
@endsection
